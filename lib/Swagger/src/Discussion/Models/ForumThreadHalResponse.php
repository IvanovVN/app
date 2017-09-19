<?php
/**
 * ForumThreadHalResponse
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * discussion
 *
 * No descripton provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 0.1.0-SNAPSHOT
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Discussion\Models;

use \ArrayAccess;

/**
 * ForumThreadHalResponse Class Doc Comment
 *
 * @category    Class */
/** 
 * @package     Swagger\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ForumThreadHalResponse implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ForumThreadHalResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = array(
        'id' => 'int',
        'post_count' => 'int',
        'forum_id' => 'int',
        'requestor_id' => 'int',
        'modification_date' => '\Swagger\Client\Discussion\Models\Instant',
        'is_viewable' => 'bool',
        'is_editable' => 'bool',
        'is_deleted' => 'bool',
        'is_held' => 'bool',
        'upvote_count' => 'int',
        'created_by' => '\Swagger\Client\Discussion\Models\UserInfo',
        'site_id' => 'int',
        'view_count' => 'int',
        'first_post_id' => 'int',
        'last_post_id' => 'int',
        'trending_score' => 'double',
        '_links' => '\Swagger\Client\Discussion\Models\HalLinks',
        'requester_id' => 'string',
        '_embedded' => '\Swagger\Client\Discussion\Models\HalForumThreadEmbedded'
    );

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = array(
        'id' => 'id',
        'post_count' => 'postCount',
        'forum_id' => 'forumId',
        'requestor_id' => 'requestorId',
        'modification_date' => 'modificationDate',
        'is_viewable' => 'isViewable',
        'is_editable' => 'isEditable',
        'is_deleted' => 'isDeleted',
        'is_held' => 'isHeld',
        'upvote_count' => 'upvoteCount',
        'created_by' => 'createdBy',
        'site_id' => 'siteId',
        'view_count' => 'viewCount',
        'first_post_id' => 'firstPostId',
        'last_post_id' => 'lastPostId',
        'trending_score' => 'trendingScore',
        '_links' => '_links',
        'requester_id' => 'requesterId',
        '_embedded' => '_embedded'
    );

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = array(
        'id' => 'setId',
        'post_count' => 'setPostCount',
        'forum_id' => 'setForumId',
        'requestor_id' => 'setRequestorId',
        'modification_date' => 'setModificationDate',
        'is_viewable' => 'setIsViewable',
        'is_editable' => 'setIsEditable',
        'is_deleted' => 'setIsDeleted',
        'is_held' => 'setIsHeld',
        'upvote_count' => 'setUpvoteCount',
        'created_by' => 'setCreatedBy',
        'site_id' => 'setSiteId',
        'view_count' => 'setViewCount',
        'first_post_id' => 'setFirstPostId',
        'last_post_id' => 'setLastPostId',
        'trending_score' => 'setTrendingScore',
        '_links' => 'setLinks',
        'requester_id' => 'setRequesterId',
        '_embedded' => 'setEmbedded'
    );

    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = array(
        'id' => 'getId',
        'post_count' => 'getPostCount',
        'forum_id' => 'getForumId',
        'requestor_id' => 'getRequestorId',
        'modification_date' => 'getModificationDate',
        'is_viewable' => 'getIsViewable',
        'is_editable' => 'getIsEditable',
        'is_deleted' => 'getIsDeleted',
        'is_held' => 'getIsHeld',
        'upvote_count' => 'getUpvoteCount',
        'created_by' => 'getCreatedBy',
        'site_id' => 'getSiteId',
        'view_count' => 'getViewCount',
        'first_post_id' => 'getFirstPostId',
        'last_post_id' => 'getLastPostId',
        'trending_score' => 'getTrendingScore',
        '_links' => 'getLinks',
        'requester_id' => 'getRequesterId',
        '_embedded' => 'getEmbedded'
    );

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = array();

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['post_count'] = isset($data['post_count']) ? $data['post_count'] : null;
        $this->container['forum_id'] = isset($data['forum_id']) ? $data['forum_id'] : null;
        $this->container['requestor_id'] = isset($data['requestor_id']) ? $data['requestor_id'] : null;
        $this->container['modification_date'] = isset($data['modification_date']) ? $data['modification_date'] : null;
        $this->container['is_viewable'] = isset($data['is_viewable']) ? $data['is_viewable'] : false;
        $this->container['is_editable'] = isset($data['is_editable']) ? $data['is_editable'] : false;
        $this->container['is_deleted'] = isset($data['is_deleted']) ? $data['is_deleted'] : false;
        $this->container['is_held'] = isset($data['is_held']) ? $data['is_held'] : false;
        $this->container['upvote_count'] = isset($data['upvote_count']) ? $data['upvote_count'] : null;
        $this->container['created_by'] = isset($data['created_by']) ? $data['created_by'] : null;
        $this->container['site_id'] = isset($data['site_id']) ? $data['site_id'] : null;
        $this->container['view_count'] = isset($data['view_count']) ? $data['view_count'] : null;
        $this->container['first_post_id'] = isset($data['first_post_id']) ? $data['first_post_id'] : null;
        $this->container['last_post_id'] = isset($data['last_post_id']) ? $data['last_post_id'] : null;
        $this->container['trending_score'] = isset($data['trending_score']) ? $data['trending_score'] : null;
        $this->container['_links'] = isset($data['_links']) ? $data['_links'] : null;
        $this->container['requester_id'] = isset($data['requester_id']) ? $data['requester_id'] : null;
        $this->container['_embedded'] = isset($data['_embedded']) ? $data['_embedded'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = array();
        if ($this->container['_links'] === null) {
            $invalid_properties[] = "'_links' can't be null";
        }
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        if ($this->container['_links'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets id
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets post_count
     * @return int
     */
    public function getPostCount()
    {
        return $this->container['post_count'];
    }

    /**
     * Sets post_count
     * @param int $post_count
     * @return $this
     */
    public function setPostCount($post_count)
    {
        $this->container['post_count'] = $post_count;

        return $this;
    }

    /**
     * Gets forum_id
     * @return int
     */
    public function getForumId()
    {
        return $this->container['forum_id'];
    }

    /**
     * Sets forum_id
     * @param int $forum_id
     * @return $this
     */
    public function setForumId($forum_id)
    {
        $this->container['forum_id'] = $forum_id;

        return $this;
    }

    /**
     * Gets requestor_id
     * @return int
     */
    public function getRequestorId()
    {
        return $this->container['requestor_id'];
    }

    /**
     * Sets requestor_id
     * @param int $requestor_id
     * @return $this
     */
    public function setRequestorId($requestor_id)
    {
        $this->container['requestor_id'] = $requestor_id;

        return $this;
    }

    /**
     * Gets modification_date
     * @return \Swagger\Client\Discussion\Models\Instant
     */
    public function getModificationDate()
    {
        return $this->container['modification_date'];
    }

    /**
     * Sets modification_date
     * @param \Swagger\Client\Discussion\Models\Instant $modification_date
     * @return $this
     */
    public function setModificationDate($modification_date)
    {
        $this->container['modification_date'] = $modification_date;

        return $this;
    }

    /**
     * Gets is_viewable
     * @return bool
     */
    public function getIsViewable()
    {
        return $this->container['is_viewable'];
    }

    /**
     * Sets is_viewable
     * @param bool $is_viewable
     * @return $this
     */
    public function setIsViewable($is_viewable)
    {
        $this->container['is_viewable'] = $is_viewable;

        return $this;
    }

    /**
     * Gets is_editable
     * @return bool
     */
    public function getIsEditable()
    {
        return $this->container['is_editable'];
    }

    /**
     * Sets is_editable
     * @param bool $is_editable
     * @return $this
     */
    public function setIsEditable($is_editable)
    {
        $this->container['is_editable'] = $is_editable;

        return $this;
    }

    /**
     * Gets is_deleted
     * @return bool
     */
    public function getIsDeleted()
    {
        return $this->container['is_deleted'];
    }

    /**
     * Sets is_deleted
     * @param bool $is_deleted
     * @return $this
     */
    public function setIsDeleted($is_deleted)
    {
        $this->container['is_deleted'] = $is_deleted;

        return $this;
    }

    /**
     * Gets is_held
     * @return bool
     */
    public function getIsHeld()
    {
        return $this->container['is_held'];
    }

    /**
     * Sets is_held
     * @param bool $is_held
     * @return $this
     */
    public function setIsHeld($is_held)
    {
        $this->container['is_held'] = $is_held;

        return $this;
    }

    /**
     * Gets upvote_count
     * @return int
     */
    public function getUpvoteCount()
    {
        return $this->container['upvote_count'];
    }

    /**
     * Sets upvote_count
     * @param int $upvote_count
     * @return $this
     */
    public function setUpvoteCount($upvote_count)
    {
        $this->container['upvote_count'] = $upvote_count;

        return $this;
    }

    /**
     * Gets created_by
     * @return \Swagger\Client\Discussion\Models\UserInfo
     */
    public function getCreatedBy()
    {
        return $this->container['created_by'];
    }

    /**
     * Sets created_by
     * @param \Swagger\Client\Discussion\Models\UserInfo $created_by
     * @return $this
     */
    public function setCreatedBy($created_by)
    {
        $this->container['created_by'] = $created_by;

        return $this;
    }

    /**
     * Gets site_id
     * @return int
     */
    public function getSiteId()
    {
        return $this->container['site_id'];
    }

    /**
     * Sets site_id
     * @param int $site_id
     * @return $this
     */
    public function setSiteId($site_id)
    {
        $this->container['site_id'] = $site_id;

        return $this;
    }

    /**
     * Gets view_count
     * @return int
     */
    public function getViewCount()
    {
        return $this->container['view_count'];
    }

    /**
     * Sets view_count
     * @param int $view_count
     * @return $this
     */
    public function setViewCount($view_count)
    {
        $this->container['view_count'] = $view_count;

        return $this;
    }

    /**
     * Gets first_post_id
     * @return int
     */
    public function getFirstPostId()
    {
        return $this->container['first_post_id'];
    }

    /**
     * Sets first_post_id
     * @param int $first_post_id
     * @return $this
     */
    public function setFirstPostId($first_post_id)
    {
        $this->container['first_post_id'] = $first_post_id;

        return $this;
    }

    /**
     * Gets last_post_id
     * @return int
     */
    public function getLastPostId()
    {
        return $this->container['last_post_id'];
    }

    /**
     * Sets last_post_id
     * @param int $last_post_id
     * @return $this
     */
    public function setLastPostId($last_post_id)
    {
        $this->container['last_post_id'] = $last_post_id;

        return $this;
    }

    /**
     * Gets trending_score
     * @return double
     */
    public function getTrendingScore()
    {
        return $this->container['trending_score'];
    }

    /**
     * Sets trending_score
     * @param double $trending_score
     * @return $this
     */
    public function setTrendingScore($trending_score)
    {
        $this->container['trending_score'] = $trending_score;

        return $this;
    }

    /**
     * Gets _links
     * @return \Swagger\Client\Discussion\Models\HalLinks
     */
    public function getLinks()
    {
        return $this->container['_links'];
    }

    /**
     * Sets _links
     * @param \Swagger\Client\Discussion\Models\HalLinks $_links
     * @return $this
     */
    public function setLinks($_links)
    {
        $this->container['_links'] = $_links;

        return $this;
    }

    /**
     * Gets requester_id
     * @return string
     */
    public function getRequesterId()
    {
        return $this->container['requester_id'];
    }

    /**
     * Sets requester_id
     * @param string $requester_id
     * @return $this
     */
    public function setRequesterId($requester_id)
    {
        $this->container['requester_id'] = $requester_id;

        return $this;
    }

    /**
     * Gets _embedded
     * @return \Swagger\Client\Discussion\Models\HalForumThreadEmbedded
     */
    public function getEmbedded()
    {
        return $this->container['_embedded'];
    }

    /**
     * Sets _embedded
     * @param \Swagger\Client\Discussion\Models\HalForumThreadEmbedded $_embedded
     * @return $this
     */
    public function setEmbedded($_embedded)
    {
        $this->container['_embedded'] = $_embedded;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}


