/* Recalculation product weight */
    AddEventHandler("catalog", "OnBeforeProductUpdate", Array("CheckProductWeight", "RecalculateWeight"));
    AddEventHandler("catalog", "OnBeforeProductAdd", Array("CheckProductWeight", "RecalculateWeight"));
    class CheckProductWeight {
        function RecalculateWeight($ID, &$arFields)
        {
                    /*dump($arFields);
                    return false;*/
                    if($arFields['WEIGHT'] || $arFields['WEIGHT'] != '') { // Проверка на наличие веса
                        $newWeight = $arFields['WEIGHT'] / 1000; // Пересчитываем вес и удаляем три нуля, потому что запятая нам не передаётся
                        CIBlockElement::SetPropertyValuesEx($arFields["ID"], IBLOCK_CATALOG_ID, array("WEIGHT_GRAMS" => $newWeight)); // Записываем в свойство   
                    }       
        }
    }
/* Recalculation product weight */
