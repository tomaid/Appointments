<?php
class VerifyEmail {
    private $user;
    private $count;
    public function __construct($connection=null, $user='') {
        $this->user=$user;
        $stmt = $connection->prepare("SELECT COUNT(*)
		FROM users
		WHERE user=?");
        $stmt->bind_param('s', $this->user);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($this->count);
        $stmt->fetch();
        $stmt->close();
    }

    /**
     * @return mixed|string
     */
    public function getCount()
    {
        return $this->count;
    }

}
?>