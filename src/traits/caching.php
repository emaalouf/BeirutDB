<?php


  trait CacheTraits {
    private function reGenerateCache() {
      $token  = $this->getCacheToken();
      $result = $this->findStoreDocuments();
      // Write the cache file.
      file_put_contents( $this->getCachePath( $token ), json_encode( $result ) );
      // Reset cache flags to avoid future queries on the same object of the store.
      $this->resetCacheFlags();
      // Return the data.
      return $result;
    }
    
    
    private function resetCacheFlags() {
      $this->makeCache = false;
      $this->useCache  = false;
    }

    private function useExistingCache() {
      $token = $this->getCacheToken();
      if ( file_exists( $this->getCachePath( $token ) ) ) {
        $this->resetCacheFlags();
        return json_decode( file_get_contents( $this->getCachePath( $token ) ), true );
      } else {
        return $this->reGenerateCache();
      }
    }

    private function getCacheToken() {
      $query = json_encode( [
        'store' => $this->storePath,
        'limit' => $this->limit,
        'skip' => $this->skip,
        'conditions' => $this->conditions,
        'orConditions' => $this->orConditions,
        'in' => $this->in,
        'notIn' => $this->notIn,
        'order' => $this->orderBy,
        'search' => $this->searchKeyword
      ] );
      return md5( $query );
    }

    private function getCachePath( $token ) {
      return $this->storePath . 'cache/' . $token . '.json';
    }

    private function _deleteCache() {
      $token = $this->getCacheToken();
      unlink( $this->getCachePath( $token ) );
    }

    private function _emptyAllCache() {
      array_map( 'unlink', glob( $this->storePath . "cache/*" ) );
    }

  }
  
