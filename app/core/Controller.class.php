<?php
/**
 * Class Controller
 */
class Controller
{
    private array $view;
    protected array $error;

    public function __construct()
    {
        $this->view = [];
        $this->error = [];

        // Validate post if exists
        $this->setValidPost();
    }


    /**
     * @return array
     */
    public function getView (): array
    {
        if (!empty($this->error)) {
            $this->setView("msgError", $this->getError());
        }

        return $this->view;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setView (string $key, mixed $value): void
    {
        $this->view[$key] = $value;
    }


    /***
     * @param mixed $error
     * @return void
     */
    public function setError (mixed $error): void
    {
        $error = (is_array($error)) ? implode('<br>', $error[0]) : $error;
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
     * @return string
     */
    private function getError (): string
    {
        return implode('<br>', $this->error);
    }


    /**
     * @return void
     */
    private function setValidPost (): void
    {
        $contentType = $_SERVER["CONTENT_TYPE"] ?? '';

        if (empty($_POST) && $contentType !== "") {
            $fetchContent = trim(file_get_contents("php://input"));
            $_POST = ($fetchContent) ? json_decode($fetchContent, true) : [];
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $v = trim($v);
                $_POST[$k] = strip_tags(htmlspecialchars(stripslashes($v)));
            }
        }
    }
}