<?php

namespace Utils;

class DataCleaner
{
    // Limpia las cadenas de strings para evitar inyeccion sql
    public static function cleanString(string $string): string
    {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = str_ireplace("<script>", "", $string);
        $string = str_ireplace("</script>", "", $string);
        $string = str_ireplace("</script src", "", $string);
        $string = str_ireplace("</script type=", "", $string);
        $string = str_ireplace("SELECT * FROM", "", $string);
        $string = str_ireplace("DELETE FROM", "", $string);
        $string = str_ireplace("INSERT INTO", "", $string);
        $string = str_ireplace("DROP TABLE", "", $string);
        $string = str_ireplace("DROP DATABASE", "", $string);
        $string = str_ireplace("TRUNCATE TABLE", "", $string);
        $string = str_ireplace("SHOW TABLES", "", $string);
        $string = str_ireplace("SHOW DATABASES", "", $string);
        $string = str_ireplace("<?php", "", $string);
        $string = str_ireplace("?>", "", $string);
        $string = str_ireplace("--", "", $string);
        $string = str_ireplace("^", "", $string);
        $string = str_ireplace("<", "", $string);
        $string = str_ireplace("[", "", $string);
        $string = str_ireplace("]", "", $string);
        $string = str_ireplace("==", "", $string);
        $string = str_ireplace(";", "", $string);
        $string = str_ireplace("::", "", $string);
        $string = trim($string);
        $string = stripcslashes($string);
        return (empty($string)) ? '' : $string;
    }

    // verificar la integridad de los datos
    public static function dataVerify($filter, string $string): bool
    {
        if (preg_match("/^" . $filter . "$/", $string)) {
            return false;
        } else {
            return true;
        }
    }

    //verifica la integridad del mail
    public static function validateEmail($email)
    {
        // Valida el formato del correo electrónico
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }




}

