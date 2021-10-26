AddEventHandler("sale", "OnSaleStatusOrder", Array("HandlerStatusChanged", "acceptDelivery"));


class HandlerStatusChanged {

	function acceptDelivery($ID, &$val)
	{
		if ($val == "T") {
			/**
				Разрешает доставку при изменении статуса на статус "Передан в службу доставки"
			*/
			Bitrix\Main\Loader::includeModule('sale');
			$order = \Bitrix\Sale\Order::load($ID);
			
			$shipmentCollection = $order->getShipmentCollection();
			
			/** @var Sale\Shipment $shipment */

			foreach ($shipmentCollection as $shipment)
			{
				if (!$shipment->isSystem())
					$shipment->allowDelivery();
			}
			
			$result = $order->save();
			if (!$result->isSuccess())
			{
				//$result->getErrors();
			}
		}
	}
}
