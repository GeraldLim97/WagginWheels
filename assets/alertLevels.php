<?php 
class Alert {
    /* Originally using backed enums, PHP 7.1 does not have this feature */
    const None = 0;
    const Success = 1;
    const Failure = 2;
    const FatalError = 3;
    public static function color($number): string {
        switch ($number) {
            case 0:
                return 'None';
            case 1:
                return 'green';
            case 2:
            case 3:
                return 'red';
            default:
                return null;
        }
    }
    public static function key($number): string{
        switch ($number) {
            case 0:
                return 'None';
            case 1:
                return 'Success';
            case 2:
            case 3:
                return 'Failure';
            default:
                return null;
        }
    }
}
?>