<?php

class EmptyFieldNameException extends \Exception {}

class EmptyConditionException extends \Exception {}

class InvalidOrderException extends \Exception {}

class InvalidConfigurationException extends \Exception {}

class IOException extends \Exception {}

class EmptyStoreNameException extends \Exception {}

if(!class_exists('JsonException')){
  class JsonException extends \Exception {}
}

class IndexNotFoundException extends \Exception {}

class EmptyStoreName extends \Exception {}

class EmptyStoreDataException extends \Exception {}

class InvalidStoreDataException extends \Exception {}
class InvalidDataException extends \Exception {}
