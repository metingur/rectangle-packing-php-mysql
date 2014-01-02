<?php

class RectanglePacking {
 
    private $root = array();

    private $usedHeight = 0;

    private $usedWidth = 0;

   

    function __construct($width, $height) {

        $this->reset($width, $height);

    }

    function reset($width, $height) {

        $this->root['x'] = 0;

        $this->root['y'] = 0;

        $this->root['w'] = $width;

        $this->root['h'] = $height;

        $this->root['lft'] = null;

        $this->root['rgt'] = null;

        $this->usedWidth = 0;

        $this->usedHeight = 0;

    }

   

    function getDimensions() {

        return array(

            'w' => $this->usedWidth,

            'h' => $this->usedHeight

        );

    }


    function cloneNode($node) {

        return array(

            'x' => $node['x'],

            'y' => $node['y'],

            'w' => $node['w'],

            'h' => $node['h']

        );

    }              

   

    function recursiveFindCoords(&$node, $w, $h) {

        if (isset($node['lft']) && is_array($node['lft'])) {

            $coords = $this->recursiveFindCoords($node['lft'], $w, $h);

            if (!$coords && isset($node['rgt']) && is_array($node['rgt'])) {

                $coords = $this->recursiveFindCoords($node['rgt'], $w, $h);

            }

            return $coords;

        }

        else

        {

            if (isset($node['used']) && $node['used'] || $w > $node['w'] || $h > $node['h'])

                return null;

                   

            if ( $w == $node['w'] && $h == $node['h'] ) {

                $node['used'] = true;

                return array(

                    'x' => $node['x'],

                    'y' => $node['y']

                );

            }

           

            $node['lft'] = $this->cloneNode($node);

            $node['rgt'] = $this->cloneNode($node);

           

            if ( $node['w'] - $w > $node['h'] - $h ) {

                $node['lft']['w'] = $w;

                $node['rgt']['x'] = $node['x'] + $w;

                $node['rgt']['w'] = $node['w'] - $w;   

            } else {

                $node['lft']['h'] = $h;

                $node['rgt']['y'] = $node['y'] + $h;

                $node['rgt']['h'] = $node['h'] - $h;                                                   

            }

           

            return $this->recursiveFindCoords($node['lft'], $w, $h);

        }

    }

   

    function findCoords($w, $h) {

        $coords = $this->recursiveFindCoords($this->root, $w, $h);

        // var_dump($this->root);

 

        if ($coords) {

            if ( $this->usedWidth < $coords['x'] + $w )

                $this->usedWidth = $coords['x'] + $w;

            if ( $this->usedHeight < $coords['y'] + $h )

                $this->usedHeight = $coords['y'] + $h;

        }

 

        return $coords;

    }

}

?>
