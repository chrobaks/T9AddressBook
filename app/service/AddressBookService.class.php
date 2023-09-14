<?php
/**
 * Include PdoApi and T9Api
 */
include_once("app/api/PdoApi.class.php");
include_once("app/api/T9Api.class.php");

/**
 * Class AddressBookService
 */
class AddressBookService
{
    /**
     * @var \PdoApi
     */
    private PdoApi $PDO;
    /**
     * @var \T9Api
     */
    private T9Api $t9Instance;
    /**
     * @var array|mixed
     */
    private mixed $formConfig;
    /**
     * @var array|mixed
     */
    private mixed $queryConfig;
    /**
     * @var array
     */
    private array $error;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        // AppPDO instance for database handling
        $this->PDO = PdoApi::get_instance();
        // T9Api instance for T9Number handling
        $this->t9Instance = T9Api::get_instance();
        // Form config, regular Expr. for validation, error messages
        $this->formConfig = $config["form"] ?? [];
        // Query config
        $this->queryConfig = $config["query"] ?? [];
        $this->error = [];
    }

    /**
     * @return void
     */
    public function addAddressBook (): void
    {
        if (is_array($_POST) && !empty($_POST)) {
            // Form validation
            $insertData = $this->getValidateAddressBook();
            // Validation success
            if (!$this->hasError()) {
                $query = str_replace("[%COLUMNS%]",implode(',', array_keys($insertData)), $this->queryConfig["insert"]["address_book"]);
                $insertId = $this->PDO->insert($query, array_values($insertData));
                if ($insertId == 0) {
                    $this->setError($this->PDO->getError());
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getAddressBook(): array
    {
        $addressBook = $this->PDO->select($this->queryConfig["select"]["address_book"]);
        // Check and handle error
        $error = $this->PDO->getError();
        if (count($error) > 0) {
            $this->setError($error);
        }

        return $addressBook;
    }

    /**
     * @return array
     */
    private function getValidateAddressBook (): array
    {
        $result = [];

        foreach ($this->formConfig["columnsExpr"]["addressBook"] as $key => $expr) {
            if (isset($_POST[$key])) {
                if (!preg_match($expr, $_POST[$key])) {
                    $this->setError($this->formConfig["columnErrors"][$key]);
                } else {
                    $result[$key] = $_POST[$key];
                }
            } else {
                $this->setError($this->formConfig["columnErrors"][$key]);
            }
        }

        return $result;
    }


    /**
     * @return array
     */
    public function getAddress (): array
    {
        $dbResult = [];
        // Only expression access if formConfig phone has post phone matches
        if (isset($_POST["phone"]) && preg_match($this->formConfig["columnsExpr"]["phone"], $_POST["phone"])) {
            // Get T9Api result with phone input
            $searchResult = $this->t9Instance->phoneToWords($_POST["phone"]);
            // Create mysql select query
            $query = str_replace("[%FIRSTNAME%]",implode("%' OR first_name LIKE '",$searchResult), $this->queryConfig["select"]["address_book_select"]);
            $query = str_replace("[%SECONDNAME%]",implode("%' OR second_name LIKE '",$searchResult), $query);
            // Get results from query
            $dbResult = $this->PDO->select($query);
            // Check and handle error
            $error = $this->PDO->getError();
            if (count($error) > 0) {
                $this->setError($error);
            }
        } else {
            // Seems something went wrong!
            $this->setError($this->formConfig["columnErrors"]["phone"]);
        }

        return $dbResult;
    }

    /***
     * @param mixed $error
     * @return void
     */
    public function setError (mixed $error): void
    {
        $this->error[] = $error;
    }

    /**
     * @return bool
     */
    public function hasError (): bool
    {
        return (count($this->error) > 0);
    }

    /**
     * @return array
     */
    public function getError (): array
    {
        return $this->error;
    }
}