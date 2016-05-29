<?php
/**
 * Class for comment
 */
class Comment {

    private $id;
    private $comment;
    private $user;

    /**
     * Constructor for comment Class
     * @param comment
     * @param user
     * @return none
     */
    function __construct($comment, $user) {
        $this->setComment($comment);
        $this->setUser($user);
    }

    /**
     * Get id of comment
     * @return id
     */
    function getId() {
        return $this->id;
    }

    /**
     * Get comment
     * @return comment
     */
    function getComment() {
        return $this->comment;
    }

    /**
     * Set id of comment
     * @param id
     * @return none
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Set comment
     * @param comment
     * @return none
     */
    function setComment($comment) {
        $this->comment = $comment;
    }

    /**
     * Get user
     * @return user
     */
    function getUser() {
        return $this->user;
    }

    /**
     * Set user
     * @return none
     */
    function setUser($user) {
        $this->user = $user;
    }
}

?>