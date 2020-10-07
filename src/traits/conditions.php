<?php


  trait ConditionsTrait {
    public function where( $fieldName, $condition, $value ) {
      if ( empty( $fieldName ) ) throw new EmptyFieldNameException( 'Field name in where condition can not be empty.' );
      if ( empty( $condition ) ) throw new EmptyConditionException( 'The comparison operator can not be empty.' );
      $this->conditions[] = [
        'fieldName' => $fieldName,
        'condition' => trim( $condition ),
        'value'     => $value
      ];
      return $this;
    }
    public function in ( $fieldName, $values = [] ) {
      if ( empty( $fieldName ) ) throw new EmptyFieldNameException( 'Field name for in clause can not be empty.' );
      $values = (array) $values;
      $this->in[] = [
        'fieldName' => $fieldName,
        'value'     => $values
      ];
      return $this;
    }
    public function notIn ( $fieldName, $values = [] ) {
      if ( empty( $fieldName ) ) throw new EmptyFieldNameException( 'Field name for notIn clause can not be empty.' );
      $values = (array) $values;
      $this->notIn[] = [
        'fieldName' => $fieldName,
        'value'     => $values
      ];
      return $this;
    }
    public function orWhere( $fieldName, $condition, $value ) {
      if ( empty( $fieldName ) ) throw new EmptyFieldNameException( 'Field name in orWhere condition can not be empty.' );
      if ( empty( $condition ) ) throw new EmptyConditionException( 'The comparison operator can not be empty.' );
      // Append the condition into the orConditions variable.
      $this->orConditions[] = [
        'fieldName' => $fieldName,
        'condition' => trim( $condition ),
        'value'     => $value
      ];
      return $this;
    }
    public function skip( $skip = 0 ) {
      if ( $skip === false ) $skip = 0;
      $this->skip = (int) $skip;
      return $this;
    }
    public function limit( $limit = 0 ) {
      if ( $limit === false ) $limit = 0;
      $this->limit = (int) $limit;
      return $this;
    }
    public function orderBy( $order, $orderBy = '_id' ) {
      // Validate order.
      $order = strtolower( $order );
      if ( ! in_array( $order, [ 'asc', 'desc' ] ) ) throw new InvalidOrderException( 'Invalid order found, please use "asc" or "desc" only.' );
      $this->orderBy = [
        'order' => $order,
        'field' => $orderBy
      ];
      return $this;
    }
    public function search( $field, $keyword) {
      if ( empty( $field ) ) throw new EmptyFieldNameException( 'Cant perform search due to no field name was provided' );
      if ( ! empty( $keyword ) ) $this->searchKeyword = [
        'field'   => (array) $field,
        'keyword' => $keyword
      ];
      return $this;
    }
    public function makeCache() {
      $this->makeCache = true;
      $this->useCache  = false;
      return $this;
    }
    public function useCache() {
      $this->useCache  = true;
      $this->makeCache = false;
      return $this;
    }
    public function deleteCache() {
      $this->_deleteCache();
      return $this;
    }
    public function deleteAllCache() {
      $this->_emptyAllCache();
      return $this;
    }
    public function keepConditions () {
      $this->shouldKeepConditions = true;
      return $this;
    }

  }
  
