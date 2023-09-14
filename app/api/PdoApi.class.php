<?php
/**
 * Include Database defines
 */
include_once("app/defines/database.define.php");
/**
 * class AppPdo (Singleton)
 */
class PdoApi
{
    private static PdoApi $instance;
    private array $error;
    public PDO $DB;

    public function __construct ()
    {
        $this->error = [];

        $this->initDB();
    }

    /**
     * @return \PdoApi
     */
    public static function get_instance(): PdoApi
    {
        if( ! isset(self::$instance)){self::$instance = new PdoApi();}

        return self::$instance;
    }

    /**
     * @return void
     */
    private function initDB (): void
    {
        if (defined('DB_HOST') && DB_HOST !== ""
            && defined('DB_NAME') && DB_NAME !== ""
            && defined('DB_USER') && DB_USER !== ""
            && defined('DB_PASS') && DB_PASS !== ""
        ) {
            try {
                $host =  "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
                // Set Instance & attributes
                $this->DB = new PDO( $host, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' COLLATE utf8_unicode_ci") );
                $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e)
            {
                if (!empty($e->getMessage())) {
                    $this->error[] = $e->getMessage();
                }
            }
        }
    }

    /**
     * @param string $query
     * @param mixed $values
     * @return int
     */
    public function insert (string $query, mixed $values): int
    {
        try {
            $stat = $this->DB->prepare($query);
            $this->DB->beginTransaction();
            $stat->execute($values);

            $lastInsertId = $this->DB->lastInsertId();
            $this->DB->commit();

        } catch(\Exception $e) {
            $this->DB->rollback();
            $this->error[] = $e->getMessage();
            $lastInsertId = 0;
        }

        return $lastInsertId;
    }

    /**
     * @param string $query
     * @return array
     */
    public function select (string $query): array
    {
        $result = [];
        try {
            $stat = $this->DB->prepare($query);
            $stat->execute();

            if ( (int) $stat->rowCount() > 0) {
                while($row = $stat->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = $row;
                }
            }
        } catch(\Exception $e) {
            $this->error[] = $e->getMessage();
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getError (): array
    {
        return $this->error;
    }
}