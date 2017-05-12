<?php
namespace Serato\Slimulator\RequestBody;

use Serato\Slimulator\RequestBody\RequestBodyAbstract;

/**
 * A request body consisting of name/value pairs of data exposed via the
 * `$_POST` PHP superglobal.
 */
abstract class RequestBodyWithParamsAbstract extends RequestBodyAbstract
{
    protected $params = [];

    /**
     * Constructs the object
     *
     * @param array $params Request params
     */
    public function __construct(array $params = [])
    {
        $this->addParams($params);
    }

    /**
     * Adds a single request parameter name and value
     *
     * @param string    $name   Parameter name
     * @param mixed     $value  Parameter value
     *
     * @return self
     */
    public function addParam(string $name, $value): self
    {
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * Adds multiple request parameters from a single name/value array.
     * eg. `['param1' => 'val1', 'param2' => 'val2']`.
     *
     * @param array $params     Name/value array of parameters
     *
     * @return self
     */
    public function addParams(array $params): self
    {
        foreach ($params as $k => $v) {
            $this->addParam($k, $v);
        }
        return $this;
    }

    /**
     * Removes a named request parameter.
     *
     * @return self
     */
    public function removeParam(string $name): self
    {
        unset($this->params[$name]);
        return $this;
    }

    /**
     * Returns the complete set of request params.
     *
     * @return array
     */
    public function getParams(): array
    {
        return count($this->params) === 0 ? null : $this->params;
    }
}
