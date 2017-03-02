<?php
//namespace Application\Pdu;

//use Application\Pdu\Pdu;
//use Application\Exception\InvalidArgumentException;

/**
 * Class PduFactory
 * @package Application\Pdu
 */

/* INCLUDES_START */

class PduFactory {

    /**
     * @param $protocolDataUnit
     * @return array
     * @throws InvalidArgumentException
     */
    public static function decode($protocolDataUnit){
        if (false ==  preg_match('/^(?!>)^[A-F0-9]+\S[0-9A-F]$/',$protocolDataUnit)) {
            throw new InvalidArgumentException(sprintf(
                '%s expects a valid protocol data unit argument; received "%s"',
                __METHOD__,
                (is_object($protocolDataUnit) ? get_class($protocolDataUnit) : gettype($protocolDataUnit))
            ));
        }
        $pdu = Pdu::getInstance();
        return $pdu->pduToText($protocolDataUnit);
    }

    /**
     * @param $params
     * @return string
     * @throws InvalidArgumentException
     */
    public static function encode($params,$multiple=false){

        if (false ===  is_array($params)) {
            throw new InvalidArgumentException(sprintf(
                '%s expects a valid argument; received "%s"',
                __METHOD__,
                (is_object($params) ? get_class($params) : gettype($params))
            ));
        }

        $pdu = Pdu::getInstance();

        if($multiple) {
            $ret = $pdu->textToPduMultiple($params);
        } else {
            $ret = $pdu->textToPduSingle($params);
        }

        return $ret;
    }

    /**
     * @param $params
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function to7bit($params){

        if (false ===  is_string($params)) {
            throw new InvalidArgumentException(sprintf(
                '%s expects a valid argument; received "%s"',
                __METHOD__,
                (is_object($params) ? get_class($params) : gettype($params))
            ));
        }

        $pdu = Pdu::getInstance();
        return ($pdu->filter($params));
    }

}

/* INCLUDES_END */
