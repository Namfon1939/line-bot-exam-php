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
				[
					"name" => "สปาเท้า",
					"price" => 700,
				],
			];

			$dataja = [];
			foreach ($serviceData as $key => $data) {
				if($key < 5) {
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
				if($key > 4){
					$services = [
						[
							"type" => "flex",
							"altText" => "Flex Message",
							"contents" => [
							  "type" => "bubble",
							  "direction" => "ltr",
							  "header" => [
								"type" => "box",
								"layout" => "vertical",
								"contents" => [
								  [
									"type" => "spacer",
									"size" => "xxl"
								  ]
								]
							  ],
							  "hero" => [
								"type" => "image",
								"url" => "https://firebasestorage.googleapis.com/v0/b/trackhilight.appspot.com/o/more.png?alt=media&token=29e4d90e-465a-4ea7-b4f2-b01df46b43d6",
								"align" => "center",
								"gravity" => "center",
								"size" => "xl",
								"aspectRatio" => "1:1",
								"backgroundColor" => "#FFFFFF",
								"action" => [
								  "type" => "uri",
								  "label" => "ทั้งหมด",
								  "uri" => "line://app/1639925368-Pqw2Qd0O/?shop_id=1"
								]
							  ],
							  "body" => [
								"type" => "box",
								"layout" => "vertical",
								"contents" => [
								  [
									"type" => "spacer"
								  ]
								]
							  ],
							  "footer" => [
								"type" => "box",
								"layout" => "horizontal",
								"contents" => [
								  [
									"type" => "spacer"
								  ]
								]
							  ]
							]
						]
					];
				}
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
			$bookingData = [
				[
					"name" => "สปาหน้า",
					"price" => 1000,
					"amount" => 1000,
					"date" => 1000,
					"time" => 1000,
					"customer_name" => "น้ำฝน",
					"note" => "note",
				],
				[
					"name" => "นวดเท้า",
					"price" => 1000,
					"amount" => 200,
					"date" => 1000,
					"time" => 1000,
					"customer_name" => "ทิว",
					"note" => "note",
				],
				[
					"name" => "นวดกำจัดเซลลูไลท์",
					"price" => 1000,
					"amount" => 2000,
					"date" => 1000,
					"time" => 1000,
					"customer_name" => "น้ำฝน",
					"note" => "note",
				],
				[
					"name" => "ซาวน่า",
					"price" => 1000,
					"amount" => 1500,
					"date" => 1000,
					"time" => 1000,
					"customer_name" => "น้ำฝน",
					"note" => "note",
				],
				[
					"name" => "ตัดผม",
					"price" => 1000,
					"amount" => 500,
					"date" => 1000,
					"time" => 1000,
					"customer_name" => "น้ำฝน",
					"note" => "note",
				],
				[
					"name" => "สปาเท้า",
					"price" => 1000,
					"amount" => 700,
					"date" => 1000,
					"time" => 1000,
					"customer_name" => "น้ำฝน",
					"note" => "note",
				],
			];

			$my_bookings = [];
			foreach ($bookingData as $key => $booking) {
			$my_bookings[] = [
				[
					"type" => "bubble",
					"direction" => "ltr",
					"header" => [
					"type" => "box",
					"layout" => "vertical",
					"contents" => [
						[
						"type" => "text",
						"text" => "#54545",
						"size" => "xl",
						"align" => "start",
						"weight" => "bold",
						"color" => "#262626"
						],
						[
						"type" => "text",
						"text" => $booking["name"],
						"margin" => "md",
						"size" => "lg",
						"align" => "start",
						"weight" => "bold",
						"color" => "#262626",
						"wrap" => true
						],
						[
						"type" => "text",
						"text" => $booking["date"].", ".$booking["time"],
						"margin" => "sm",
						"size" => "xs",
						"align" => "start",
						"color" => "#8C8C8C",
						"wrap" => true
						]
					]
					],
					"body" => [
					"type" => "box",
					"layout" => "vertical",
					"contents" => [
						[
						"type" => "separator",
						"margin" => "xl",
						"color" => "#DFDFDF"
						],
						[
						"type" => "box",
						"layout" => "baseline",
						"margin" => "xl",
						"contents" => [
							[
							"type" => "text",
							"text" => "x".$booking["amount"],
							"flex" => 1,
							"size" => "xs",
							"color" => "#8C8C8C",
							"wrap" => true
							],
							[
							"type" => "text",
							"text" => "฿".$booking["amount"] * $booking["price"],
							"size" => "xs",
							"align" => "end",
							"weight" => "bold",
							"color" => "#262626",
							"wrap" => true
							]
						]
						],
						[
						"type" => "separator",
						"margin" => "xl",
						"color" => "#DFDFDF"
						],
						[
						"type" => "box",
						"layout" => "baseline",
						"margin" => "xxl",
						"contents" => [
							[
							"type" => "text",
							"text" => "ผู้จอง:",
							"size" => "sm",
							"color" => "#8C8C8C",
							"wrap" => true
							],
							[
							"type" => "text",
							"text" => $booking["customer_name"],
							"size" => "sm",
							"align" => "end",
							"color" => "#262626",
							"wrap" => true
							]
						]
						],
						[
						"type" => "box",
						"layout" => "baseline",
						"margin" => "lg",
						"contents" => [
							[
							"type" => "text",
							"text" => "หมายเหตุ:",
							"color" => "#8C8C8C"
							],
							[
							"type" => "text",
							"text" => $booking["note"],
							"size" => "sm",
							"align" => "end",
							"color" => "#262626",
							"wrap" => true
							]
						]
						]
					]
					],
					"footer" => [
					"type" => "box",
					"layout" => "vertical",
					"contents" => [
						[
						"type" => "spacer",
						"size" => "xl"
						],
						[
						"type" => "button",
						"action" => [
							"type" => "postback",
							"label" => "ยกเลิกการจอง",
							"text" => "cancel",
							"data" => "action=cancel&bookingId=1"
						],
						"color" => "#FF3B30"
						]
					]
					]
				],
				];
			}

			$my_booking_json = [
				"type" => "flex",
				"altText" => "Flex Message",
				"contents" => [
					"type" => "carousel",
					"contents" => $my_bookings
				]
			];
			$messages = $my_booking_json;
		}
		if ($event['type'] == 'message' && $event['message']['text'] == 'mybooking') {
			$code = "#46547";
			$mybooking_json = json_decode(file_get_contents("mybooking.json"),true);
			$mybooking_json['contents']['header']['contents'][0]['text'] = $code;
			$mybooking_json['contents']['header']['contents'][1]['text'] = 'นวดฝ่าเท้า';
			$mybooking_json['contents']['header']['contents'][2]['text'] = '12/12/2020, 19:00';
			$mybooking_json['contents']['body']['contents'][1]['contents'][0]['text'] = 'x76';
			$mybooking_json['contents']['body']['contents'][1]['contents'][1]['text'] = '9,899 ฿';
			$mybooking_json['contents']['body']['contents'][3]['contents'][1]['text'] = 'เจ้น้ำ';
			$mybooking_json['contents']['body']['contents'][4]['contents'][1]['text'] = 'ขอมือเบาๆ';
			$mybooking_json['contents']['footer']['contents'][1]['action']['displayText'] = "cancel";
			$mybooking_json['contents']['footer']['contents'][1]['action']['data'] = 'action=cancel&booking='.$code;
			// $text = $event['source']['userId'];
			// $messages = [
			// 	'type' => 'text',
			// 	'text' => $text
			// ];
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
						  "uri": "https://www.google.co.th/maps/@18.7877873,98.9534804,18z/data=!4m2!10m1!1e2?hl=en&authuser=0"
						},
						"height": "sm",
						"style": "link"
					  },
					  {
						"type": "button",
						"action": {
						  "type": "uri",
						  "label": "เพิ่มเติม",
						  "uri": "line://app/1639925368-G4m102RW?shop_id=1"
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
