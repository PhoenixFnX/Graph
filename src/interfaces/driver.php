<?php
/**
 * File containing the abstract ezcGraphDriver class
 *
 * @package Graph
 * @version //autogentag//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Base options class for all eZ components.
 *
 * @package Graph
 */
abstract class ezcGraphDriver
{
    /**
     * Drveroptions
     * 
     * @var ezcDriverOptions
     */
    protected $options;

    /**
     * Width of image in pixel
     * 
     * @var integer
     */
    protected $width;

    /**
     * Height of image in pixel
     * 
     * @var integer
     */
    protected $height;
    
    const PNG = 1;
    const JPEG = 2;
    const JPG = 2;

    public function __construct( array $options = array() )
    {
        $this->options = new ezcGraphDriverOptions( $options );
    }
    
    /**
     * Options write access
     * 
     * @throws ezcBasePropertyNotFoundException
     *          If Option could not be found
     * @throws ezcBaseValueException
     *          If value is out of range
     * @param mixed $propertyName   Option name
     * @param mixed $propertyValue  Option value;
     * @return mixed
     */
    public function __set( $propertyName, $propertyValue ) 
    {
        switch ( $propertyName ) {
            case 'options':
                if ( $propertyValue instanceof ezcGraphDriverOptions )
                {
                    $this->options = $propertyValue;
                }
                else
                {
                    throw new ezcBaseValueException( "options", $propertyValue, "instanceof ezcGraphOptions" );
                }
            default:
                throw new ezcBasePropertyNotFoundException( $propertyName );
                break;
        }
    }

    /**
     * Returns the requested property 
     * 
     * @param mixed $propertyName 
     * @return mixed
     */
    public function __get( $propertyName )
    {
        if ( isset( $this->$propertyName ) )
        {
            return $this->$propertyName;
        }
        else
        {
            throw new ezcBasePropertyNotFoundException( $propertyName );
        }
    }

    /**
     * Draws a single polygon 
     * 
     * @param mixed $points 
     * @param ezcGraphColor $color 
     * @param mixed $filled 
     * @return void
     */
    abstract public function drawPolygon( array $points, ezcGraphColor $color, $filled = true );
    
    /**
     * Draws a single line
     * 
     * @param ezcGraphCoordinate $start 
     * @param ezcGraphCoordinate $end 
     * @param ezcGraphColor $color 
     * @return void
     */
    abstract public function drawLine( ezcGraphCoordinate $start, ezcGraphCoordinate $end, ezcGraphColor $color );
    
    /**
     * Wrties text in a box of desired size
     * 
     * @param mixed $string 
     * @param ezcGraphCoordinate $position 
     * @param mixed $width 
     * @param mixed $height 
     * @param ezcGraphColor $color 
     * @return void
     */
    abstract public function drawTextBox( $string, ezcGraphCoordinate $position, $width, $height, $align );
    
    /**
     * Draws a sector of cirlce
     * 
     * @param ezcGraphCoordinate $center 
     * @param mixed $width
     * @param mixed $height
     * @param mixed $startAngle 
     * @param mixed $endAngle 
     * @param ezcGraphColor $color 
     * @return void
     */
    abstract public function drawCircleSector( ezcGraphCoordinate $center, $width, $height, $startAngle, $endAngle, ezcGraphColor $color );
    
    /**
     * Draws a circular arc
     * 
     * @param ezcGraphCoordinate $center 
     * @param mixed $width 
     * @param mixed $height 
     * @param mixed $startAngle 
     * @param mixed $endAngle 
     * @param ezcGraphColor $color 
     * @return void
     */
    abstract public function drawCircularArc( ezcGraphCoordinate $center, $width, $height, $startAngle, $endAngle, ezcGraphColor $color );
    
    /**
     * Draws a circle
     * 
     * @param ezcGraphCoordinate $center 
     * @param mixed $width
     * @param mixed $height
     * @param ezcGraphColor $color
     * @param bool $filled
     *
     * @return void
     */
    abstract public function drawCircle( ezcGraphCoordinate $center, $width, $height, ezcGraphColor $color, $filled = true );
    
    /**
     * Draws a imagemap of desired size
     * 
     * @param mixed $file 
     * @param ezcGraphCoordinate $position 
     * @param mixed $width 
     * @param mixed $height 
     * @return void
     */
    abstract public function drawImage( $file, ezcGraphCoordinate $position, $width, $height );

    /**
     * Finally save image
     * 
     * @param mixed $file 
     * @return void
     */
    abstract public function render( $file );
}

?>
