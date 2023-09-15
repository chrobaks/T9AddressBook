<?php
/**
 * Include Class Controller
 */
include_once("app/core/Controller.class.php");

/**
 * Include Class AddressBookService
 */
include_once("app/service/AddressBookService.class.php");

/**
 * Class IndexController
 */
class IndexController extends Controller
{
    /**
     * @var \AddressBookService
     */
    private AddressBookService $Service;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();

        // Instance AddressBookService
        $this->Service = new AddressBookService($config);
        // Set form action, if form submitted
        $this->setFormAction();
        // Get address_book entries and set view param addressBook
        $this->setView("addressBook", $this->Service->getAddressBook());
        // Get number letters config and set view param numberLetterConfig
        $this->setView("numberLetterConfig", $this->Service->getNumberLettersConfig());
    }

    /**
     * @return void
     */
    private function setFormAction (): void
    {
        // Get form action
        $action = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) ?? "";

        switch ($action)
        {
            case"addAddressBook":
                $this->Service->addAddressBook();
                if (!$this->Service->hasError()) {
                    $this->setView("msgInfo", "Die Adresse wurde gespeichert.");
                }
                break;
            case"getAddress":
                $dbResult = $this->Service->getAddress();
                if (!$this->Service->hasError()) {
                    $this->setView("searchResult", $dbResult);
                }
                break;
        }
        if ($this->Service->hasError()) {
            $this->setError($this->Service->getError());
        }
    }
}