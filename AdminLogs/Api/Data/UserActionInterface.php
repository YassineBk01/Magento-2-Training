<?php
namespace Training\AdminLogs\Api\Data;

interface UserActionInterface
{
     /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Login Date
     *
     * @return string|null
     */
    public function getLoginDate();

    /**
     * Get User Name
     *
     * @return string|null
     */
    public function getUserName();

    /**
     * Get Session ID
     *
     * @return string|null
     */
    public function getSessionId();

    /**
     * Get User ID
     *
     * @return int|null
     */
    public function getUserId();

    /**
     * Get Email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get IP Address
     *
     * @return string|null
     */
    public function getIpAddress();

    /**
     * Get Logout Date
     *
     * @return string|null
     */
    public function getLogoutDate();

    /**
     * Get Action Type
     *
     * @return string|null
     */
    public function getActionType();

    /**
     * Get Affected Module
     *
     * @return string|null
     */
    public function getAffectedModule();

    /**
     * Get is deleted flag
     *
     * @return bool|null
     */
    public function isDeleted();

}
