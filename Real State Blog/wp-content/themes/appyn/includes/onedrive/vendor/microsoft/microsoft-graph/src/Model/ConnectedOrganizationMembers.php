<?php
/**
* Copyright (c) Microsoft Corporation.  All Rights Reserved.  Licensed under the MIT License.  See License in the project root for license information.
* 
* ConnectedOrganizationMembers File
* PHP version 7
*
* @category  Library
* @package   Microsoft.Graph
* @copyright (c) Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://graph.microsoft.com
*/
namespace Microsoft\Graph\Model;
/**
* ConnectedOrganizationMembers class
*
* @category  Model
* @package   Microsoft.Graph
* @copyright (c) Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://graph.microsoft.com
*/
class ConnectedOrganizationMembers extends SubjectSet
{
    /**
    * Gets the connectedOrganizationId
    * The ID of the connected organization in entitlement management.
    *
    * @return string|null The connectedOrganizationId
    */
    public function getConnectedOrganizationId()
    {
        if (array_key_exists("connectedOrganizationId", $this->_propDict)) {
            return $this->_propDict["connectedOrganizationId"];
        } else {
            return null;
        }
    }

    /**
    * Sets the connectedOrganizationId
    * The ID of the connected organization in entitlement management.
    *
    * @param string $val The value of the connectedOrganizationId
    *
    * @return ConnectedOrganizationMembers
    */
    public function setConnectedOrganizationId($val)
    {
        $this->_propDict["connectedOrganizationId"] = $val;
        return $this;
    }
    /**
    * Gets the description
    * The name of the connected organization. Read only.
    *
    * @return string|null The description
    */
    public function getDescription()
    {
        if (array_key_exists("description", $this->_propDict)) {
            return $this->_propDict["description"];
        } else {
            return null;
        }
    }

    /**
    * Sets the description
    * The name of the connected organization. Read only.
    *
    * @param string $val The value of the description
    *
    * @return ConnectedOrganizationMembers
    */
    public function setDescription($val)
    {
        $this->_propDict["description"] = $val;
        return $this;
    }
}
