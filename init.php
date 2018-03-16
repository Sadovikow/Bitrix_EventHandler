/* Recalculation product weight */
    AddEventHandler("catalog", "OnBeforeProductUpdate", Array("CheckProductWeight", "RecalculateWeight"));
    AddEventHandler("catalog", "OnBeforeProductAdd", Array("CheckProductWeight", "RecalculateWeight"));
    class CheckProductWeight {
        function RecalculateWeight($ID, &$arFields)
        {
                    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "CATALOG_WEIGHT");
                    $arFilter = Array("IBLOCK_ID"=> IBLOCK_CATALOG_ID, "ID" => $arFields["ID"]);
                    $dbFields = CIBlockElement::GetList(false, $arFilter, false, Array("nPageSize"=> 1), $arSelect);
                    while($dbElement = $dbFields->GetNextElement())
                    {
                        $arResult = $dbElement->GetFields();
                        if($arResult['CATALOG_WEIGHT'] || $arResult['CATALOG_WEIGHT'] != '') { // Проверка на наличие веса
                        	$newWeight = $arResult['CATALOG_WEIGHT'] / 1000; // Пересчитываем вес и удаляем три нуля, потому что запятая нам не передаётся
    						CIBlockElement::SetPropertyValuesEx($arFields["ID"], IBLOCK_CATALOG_ID, array("WEIGHT_GRAMS" => $newWeight)); // Записываем в свойство   
                        }
                    }           
                
        }
    }
/* Recalculation product weight */
