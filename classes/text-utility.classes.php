<?php

class TextUtility
{
    /**
     * Shortens a UTF-8 string to a specified length.
     * @param $inputString String to edit.
     * @param null $maxLength max length, in characters, to reduce string.
     * @return mixed|string shortened string.
     */
    public function shortenString($inputString, $maxLength = null)
    {
        // if no length is specified or the string is already smaller than the specified value return original string.
        if ($maxLength === null || mb_strlen($inputString, 'UTF-8') <= $maxLength)
        {
            return $inputString;
        }

        // otherwise return reduced UTF-8 string based on specified length.
        return mb_substr($inputString, 0, $maxLength, 'UTF-8') . '...';
    }

}