<?php

namespace LeadCommerce\Shopware\SDK\Query;

use GuzzleHttp\Exception\GuzzleException;
use LeadCommerce\Shopware\SDK\Exception\MethodNotAllowedException;
use LeadCommerce\Shopware\SDK\Exception\NotValidApiResponseException;
use LeadCommerce\Shopware\SDK\ShopwareClient;
use LeadCommerce\Shopware\SDK\Util\Constants;
use Psr\Http\Message\ResponseInterface;
use stdClass;

/**
 * Class Base
 *
 * @author Alexander Mahrt <amahrt@leadcommerce.de>
 * @copyright 2016 LeadCommerce <amahrt@leadcommerce.de>
 */
abstract class Base
{
    /**
     * @var ShopwareClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $queryPath;

    /**
     * @var array
     */
    protected $methodsAllowed = [
        Constants::METHOD_CREATE,
        Constants::METHOD_GET,
        Constants::METHOD_GET_BATCH,
        Constants::METHOD_UPDATE,
        Constants::METHOD_UPDATE_BATCH,
        Constants::METHOD_DELETE,
        Constants::METHOD_DELETE_BATCH,
    ];

    /**
     * @var string
     */
    protected $raw_response;

    /**
     * @var array
     */
    protected $array_response;

    /**
     * @var \LeadCommerce\Shopware\SDK\Entity\Base
     */
    protected $entity;

    /**
     * @var \LeadCommerce\Shopware\SDK\Entity\Base[]
     */
    protected $entities;

    /**
     * Base constructor.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->queryPath = $this->getQueryPath();
    }

    /**
     * @return string
     */
    public function getRawResponse()
    {
        return $this->raw_response;
    }

    /**
     * @param null $key
     * @return array
     */
    public function getArrayResponse($key = null)
    {
        if (!$key) return $this->array_response;
        return $this->array_response[$key];
    }

    /**
     * @param $property
     * @param $expression
     * @param $value
     * @return $this
     */
    public function withFilter($property, $expression, $value)
    {
        $this->client->withFilter($property, $expression, $value);
        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function withParam($name, $value)
    {
        $this->client->withParam($name, $value);
        return $this;
    }

    /**
     * @return $this
     */
    public function resetParams()
    {
        $this->client->resetParams();
        return $this;
    }

    /**
     * @return \LeadCommerce\Shopware\SDK\Entity\Base
     * @throws NotValidApiResponseException
     */
    public function getEntity()
    {
        if (!$this->entity) {
            $entity_result = $this->createEntityFromResponse($this->raw_response);

            if (is_array($entity_result)) {
                $this->entity = count($entity_result) > 0 ? reset($entity_result) : null;
            } else {
                $this->entity = $entity_result;
            }
        }

        return $this->entity;
    }

    /**
     * @return \LeadCommerce\Shopware\SDK\Entity\Base[]
     * @throws NotValidApiResponseException
     */
    public function getEntities()
    {
        if (!$this->entities) {
            $entity_result = $this->createEntityFromResponse($this->raw_response);

            if (is_array($entity_result)) {
                $this->entities = $entity_result;
            } else {
                $this->entities = [$entity_result];
            }
        }

        return $this->entities;
    }

    /**
     * Gets the query path to look for entities.
     * E.G: 'variants' or 'articles'
     *
     * @return string
     */
    abstract protected function getQueryPath();

    /**
     * Validates if the requested method is allowed.
     *
     * @param $method
     *
     * @throws MethodNotAllowedException
     */
    private function validateMethodAllowed($method)
    {
        if (!in_array($method, $this->methodsAllowed)) {
            throw new MethodNotAllowedException('Method ' . $method . ' is not allowed for ' . get_class($this));
        }
    }

    /**
     * Fetch and build entity.
     *
     * @param $uri
     * @param string $method
     * @param null $body
     * @param array $headers
     *
     * @return Base
     * @throws GuzzleException
     */
    protected function fetch($uri, $method = 'GET', $body = null, $headers = [])
    {
        $response = $this->client->request($uri, $method, $body, $headers);

        $this->raw_response = $response->getBody()->getContents();
        $this->array_response = json_decode($this->raw_response, true);

        return $this;
    }

    /**
     * Creates an entity
     *
     * @param ResponseInterface|string $response
     *
     * @return array|mixed
     * @throws NotValidApiResponseException
     */
    protected function createEntityFromResponse($response)
    {
        if ($response instanceof ResponseInterface) {
            $raw_response = $response->getBody()->getContents();
        } else {
            $raw_response = $response;
        }

        $content = json_decode($raw_response);

        if (json_last_error() > 0)
            throw New NotValidApiResponseException($raw_response);

        $content = $content->data;

        if (is_array($content)) {
            return array_map(function ($item) {
                return $this->createEntity($item);
            }, $content);
        } else {
            return $this->createEntity($content);
        }
    }

    /**
     * Creates an entity based on the getClass method.
     *
     * @param $content
     *
     * @return \LeadCommerce\Shopware\SDK\Entity\Base
     */
    protected function createEntity($content)
    {
        $class = $this->getClass();
        $entity = new $class();

        if ($entity instanceof \LeadCommerce\Shopware\SDK\Entity\Base) {
            $content = json_decode(json_encode($content), true);
            $entity->setEntityAttributes($content);
        }

        return $entity;
    }

    /**
     * Gets the class for the entities.
     *
     * @return string
     */
    abstract protected function getClass();

    /**
     * Finds all entities.
     *
     * @return Base
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function findAll()
    {
        $this->validateMethodAllowed(Constants::METHOD_GET_BATCH);
        return $this->fetch($this->queryPath);
    }

    /**
     * Finds an entity by its id.
     *
     * @param $id
     *
     * @return Base
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function findOne($id)
    {
        $this->validateMethodAllowed(Constants::METHOD_GET);
        return $this->fetch($this->queryPath . '/' . $id);
    }

    /**
     * Creates an entity.
     *
     * @param \LeadCommerce\Shopware\SDK\Entity\Base $entity
     *
     * @return Base
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function create(\LeadCommerce\Shopware\SDK\Entity\Base $entity)
    {
        $this->validateMethodAllowed(Constants::METHOD_CREATE);

        return $this->fetch($this->queryPath, 'POST', $entity->getArrayCopy());
    }

    /**
     * Updates an entity.
     *
     * @param \LeadCommerce\Shopware\SDK\Entity\Base $entity
     *
     * @return array|mixed
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function update(\LeadCommerce\Shopware\SDK\Entity\Base $entity)
    {
        $this->validateMethodAllowed(Constants::METHOD_UPDATE);

        return $this->fetch($this->queryPath . '/' . $entity->getId(), 'PUT', $entity->getArrayCopy());
    }

    /**
     * Updates a batch of this entity.
     *
     * @param \LeadCommerce\Shopware\SDK\Entity\Base[] $entities
     *
     * @return Base
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function updateBatch($entities)
    {
        $this->validateMethodAllowed(Constants::METHOD_UPDATE_BATCH);
        $body = [];
        foreach ($entities as $entity) {
            $body[] = $entity->getArrayCopy();
        }

        return $this->fetch($this->queryPath . '/', 'PUT', $body);
    }

    /**
     * Deletes an entity by its id..
     *
     * @param $id
     *
     * @return array|mixed
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function delete($id)
    {
        $this->validateMethodAllowed(Constants::METHOD_DELETE);

        return $this->fetch($this->queryPath . '/' . $id, 'DELETE');
    }

    /**
     * Deletes a batch of this entity given by ids.
     *
     * @param array $ids
     *
     * @return array|mixed
     * @throws MethodNotAllowedException
     * @throws GuzzleException
     */
    public function deleteBatch(array $ids)
    {
        $this->validateMethodAllowed(Constants::METHOD_DELETE_BATCH);

        return $this->fetch($this->queryPath . '/', 'DELETE', $ids);
    }

    /**
     * @param $uri
     * @param string $method
     * @param null $body
     * @param array $headers
     *
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function fetchSimple($uri, $method = 'GET', $body = null, $headers = [])
    {
        return $this->client->request($uri, $method, $body, $headers);
    }

    /**
     * Fetch as json object.
     *
     * @param $uri
     * @param string $method
     * @param null $body
     * @param array $headers
     *
     * @return false|stdClass
     * @throws GuzzleException
     */
    public function fetchJson($uri, $method = 'GET', $body = null, $headers = [])
    {
        $response = $this->client->request($uri, $method, $body, $headers);
        $response = json_decode($response->getBody()->getContents());

        return $response ? $response : null;
    }

    /**
     * Fetch as array
     *
     * @param $uri
     * @param string $method
     * @param null $body
     * @param array $headers
     *
     * @return mixed|null
     * @throws GuzzleException
     */
    public function fetchArray($uri, $method = 'GET', $body = null, $headers = [])
    {
        $response = $this->client->request($uri, $method, $body, $headers);
        $response = json_decode($response->getBody()->getContents(), true);

        return $response ? $response : null;
    }
}
