<?php

class CacheMemoryCollect extends CacheMemory {

    /**
     * Принудительно запускает сборку мусора
     *
     * @return array
     */
    public function collect() {

        $slabs = memcache_get_stats($this->connection, 'slabs');

        foreach ($slabs as $slabid => $slab) {

            if (is_numeric($slabid)) {
                $cachedump = memcache_get_stats($this->connection, 'cachedump', $slabid);
                foreach ($cachedump as $name => $info) {
                    $item = array(
                        'name' => $name,
                        'slab' => array( $slabid ),
                        'size' => $info[0],
                        'timeout' => $info[1] - $this->extend_stats['time'],
                        'expire' => $info[1],
                        'raw' => $info,
                    );

                    $items[] = $item;
                }

            }
        }

        //reset, malloc, maps, cachedump, slabs, items, sizes
//      $r = memcache_get_stats($this->connection, 'sizes', $slabid);
//      var_dump( $r );

        return $items;
    }

}
