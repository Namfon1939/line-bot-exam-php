<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'QychfE1EJmMXXPlIc1r2POjrjG9+aZm1mueegxanDbMDmOF+LYYCWo7jACB01mi6JtNeePsSl8kEiSGt4VOIUL2jAAdj9ZKohwsyIoluQ7WTzGsRPTOTEFzCps76rBTiCCY3LK+mSOlcEEUvahksGQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['text'] == 'services') {
			$serviceData = [
				[
					"name" => "สปาหน้า",
					"price" => 1000,
				],
				[
					"name" => "นวดเท้า",
					"price" => 200,
				],
				[
					"name" => "นวดกำจัดเซลลูไลท์",
					"price" => 2000,
				],
				[
					"name" => "ซาวน่า",
					"price" => 1500,
				],
				[
					"name" => "ตัดผม",
					"price" => 500,
				],
			];

			$dataja = [];
			foreach ($serviceData as $key => $data) {
				$dataja[] = [
					"type" => "bubble",
					"direction" => "ltr",
					"hero" => [
						"type" => "image",
						"url" => "https://lh3.googleusercontent.com/proxy/-1c7kpqSBd9MstpLoL1SssBqYrwCIFRJEO0GHycFDq7ZfioJKWjNkF1Qn7jex6Z18Kr51k_W2Oa5vHimHAIDDMVdGQbvjHHu6tKcXSWQxfuOT8NSvjOfZGTi1VR8e9aYNA_y",
						"align" => "center",
						"size" => "full",
						"aspectRatio" => "4:3",
						"aspectMode" => "cover",
						"action" => [
							"type" => "uri",
							"label" => "Line",
							"uri" => "https://ashop.avalue.co.th/phpmyadmin/db_structure.php?server=1&db=avalue_ashop&token=8d7d7bc20f1fe6a544e0d97331766383"
						]
					],
					"body" => [
						"type" => "box",
						"layout" => "vertical",
						"action" => [
							"type" => "uri",
							"label" => "Line",
							"uri" => "https://ashop.avalue.co.th/phpmyadmin/db_structure.php?server=1&db=avalue_ashop&token=8d7d7bc20f1fe6a544e0d97331766383"
						],
						"contents" => [
							[
							"type" => "text",
							"text" => $data['name'],
							"size" => "lg",
							"weight" => "bold",
							"color" => "#000000",
							"wrap" => true
							],
							[
							"type" => "text",
							"text" => "ทุกวัน",
							"margin" => "sm",
							"align" => "start",
							"color" => "#B9B9B9",
							"wrap" => true
							],
							[
							"type" => "text",
							"text" => $data['price']." ฿",
							"margin" => "xl",
							"size" => "lg",
							"weight" => "bold",
							"color" => "#3361F4",
							"wrap" => true
							],
							[
							"type" => "spacer",
							"size" => "xl"
							]
						]
					]
				];
			}

			$service_json = [
				"type" => "flex",
				"altText" => "Flex Message",
				"contents" => [
					"type" => "carousel",
					"contents" => $dataja
				]
			];

			$messages = $service_json;
			
			// $service_json = json_decode(file_get_contents("services.json"),true);
			// $service_json['contents']['hero']['url'] = 'https://lh3.googleusercontent.com/proxy/-1c7kpqSBd9MstpLoL1SssBqYrwCIFRJEO0GHycFDq7ZfioJKWjNkF1Qn7jex6Z18Kr51k_W2Oa5vHimHAIDDMVdGQbvjHHu6tKcXSWQxfuOT8NSvjOfZGTi1VR8e9aYNA_y';
			// $service_json['contents']['body']['contents'][0]['text'] = 'นวดฝ่าเท้า';
			// $service_json['contents']['body']['contents'][1]['text'] = 'จ อ พฤ ศ';
			// $service_json['contents']['body']['contents'][2]['text'] = '9,999 ฿';
			// $messages = $service_json;
		}
		if ($event['type'] == 'message' && $event['message']['text'] == 'promotions') {
			$messages = json_decode(file_get_contents("promotions.json"),true);
		}
		if ($event['type'] == 'message' && $event['message']['text'] == 'mybooking') {
			$url = 'https://api.line.me/v2/bot/profile';

			$headers = array('Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			// echo $result;
			// // dd($result);

			// $code = "#46547";
			// $mybooking_json = json_decode(file_get_contents("mybooking.json"),true);
			// $mybooking_json['contents']['header']['contents'][0]['text'] = $code;
			// $mybooking_json['contents']['header']['contents'][1]['text'] = 'นวดฝ่าเท้า';
			// $mybooking_json['contents']['header']['contents'][2]['text'] = '12/12/2020, 19:00';
			// $mybooking_json['contents']['body']['contents'][1]['contents'][0]['text'] = 'x76';
			// $mybooking_json['contents']['body']['contents'][1]['contents'][1]['text'] = '9,899 ฿';
			// $mybooking_json['contents']['body']['contents'][3]['contents'][1]['text'] = 'เจ้น้ำ';
			// $mybooking_json['contents']['body']['contents'][4]['contents'][1]['text'] = 'ขอมือเบาๆ';
			// $mybooking_json['contents']['footer']['contents'][1]['action']['displayText'] = "cancel";
			// $mybooking_json['contents']['footer']['contents'][1]['action']['data'] = 'action=cancel&booking='.$code;
			$messages = $result;
		}
		if ($event['type'] == 'postback') {
			$data = explode("&", $event['postback']['data']);
			if($data[0] == 'action=cancel') {
				$con_json = json_decode(file_get_contents("confirmCancel.json"),true);
				$con_json['contents']['header']['contents'][0]['text'] = 'ยกเลิกจริงป่ะจ้ะ'.$data[1];
				$con_json['contents']['footer']['contents'][0]['contents'][0]['action']['data'] = 'action=yescancel&' .$data[1];
				$con_json['contents']['footer']['contents'][0]['contents'][1]['action']['data'] = 'action=nocancel&' .$data[1];
				$messages = $con_json; 
			}
			if($data[0] == 'action=yescancel') {
				$cancel_json = json_decode(file_get_contents("cancel.json"),true);
				$messages = $cancel_json;
			}
			if($data[0] == 'action=nocancel') {
				$messages = [
					'type' => 'text',
					'text' => 'no no no'
				];
			}
		}
		if ($event['type'] == 'message' && $event['message']['text'] == 'shopinfo') {
			$shop_info = '{
				"type": "flex",
				"altText": "Flex Message",
				"contents": {
				  "type": "bubble",
				  "hero": {
					"type": "image",
					"url": "https://f.ptcdn.info/945/029/000/1427894585-guccih-o.jpg",
					"size": "full",
					"aspectRatio": "20:13",
					"aspectMode": "cover",
					"action": {
					  "type": "uri",
					  "label": "Line",
					  "uri": "https://linecorp.com/"
					}
				  },
				  "body": {
					"type": "box",
					"layout": "vertical",
					"contents": [
					  {
						"type": "text",
						"text": "Brown Cafe",
						"size": "xl",
						"weight": "bold"
					  },
					  {
						"type": "box",
						"layout": "vertical",
						"spacing": "sm",
						"margin": "lg",
						"contents": [
						  {
							"type": "box",
							"layout": "baseline",
							"spacing": "xl",
							"contents": [
							  {
								"type": "icon",
								"url": "https://cdn3.iconfinder.com/data/icons/unicons-vector-icons-pack/32/phone-512.png"
							  },
							  {
								"type": "text",
								"text": "081-232-5559",
								"flex": 5,
								"size": "sm",
								"color": "#666666",
								"wrap": true
							  }
							]
						  },
						  {
							"type": "box",
							"layout": "baseline",
							"spacing": "xl",
							"contents": [
							  {
								"type": "icon",
								"url": "https://cdn3.iconfinder.com/data/icons/unicons-vector-icons-pack/32/phone-512.png"
							  },
							  {
								"type": "text",
								"text": "123/35 ข้างโรงแรมเชียงใหมภูคํา",
								"flex": 5,
								"size": "sm",
								"color": "#666666",
								"wrap": true
							  }
							]
						  },
						  {
							"type": "box",
							"layout": "baseline",
							"spacing": "xl",
							"contents": [
							  {
								"type": "icon",
								"url": "https://cdn3.iconfinder.com/data/icons/unicons-vector-icons-pack/32/phone-512.png"
							  },
							  {
								"type": "text",
								"text": "จันทร์ - ศุกร์, 08:00-18:00 น.",
								"flex": 5,
								"size": "sm",
								"color": "#666666",
								"wrap": true
							  }
							]
						  }
						]
					  }
					]
				  },
				  "footer": {
					"type": "box",
					"layout": "vertical",
					"flex": 0,
					"spacing": "sm",
					"contents": [
					  {
						"type": "button",
						"action": {
						  "type": "uri",
						  "label": "โทรออก",
						  "uri": "tel:0839651517"
						}
					  },
					  {
						"type": "button",
						"action": {
						  "type": "uri",
						  "label": "นำทาง",
						  "uri": "https://linecorp.com"
						},
						"height": "sm",
						"style": "link"
					  },
					  {
						"type": "button",
						"action": {
						  "type": "uri",
						  "label": "เพิ่มเติม",
						  "uri": "https://linecorp.com"
						}
					  },
					  {
						"type": "spacer",
						"size": "sm"
					  }
					]
				  }
				}
			  }';
			$shopinfo_json = json_decode($shop_info);
			$messages = $shopinfo_json;
		}
		
		// Get replyToken
		$replyToken = $event['replyToken'];
		$url = 'https://api.line.me/v2/bot/message/reply';
		$data = [
			'replyToken' => $replyToken,
			'messages' => [$messages],
		];
		$post = json_encode($data);
		$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);

		echo $result . "\r\n";
	}
}
echo "OK";
