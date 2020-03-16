<?php // callback.php

require "vendor/autoload.php";
//require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

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
					$dataja[5] = [
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
			$promotionData = [
				[
					"logo_path" => "สปาหน้า",
					"name" => "สปาหน้า",
					"start_date" => "31/01/2020",
					"end_date" => "31/03/2020",
					"discount" => 30,
					"discount_type" => "PERCENT",
					"coupon_number" => "PREBOOK30",
					"description" => "description",
				],
				[
					"logo_path" => "สปาหน้า",
					"name" => "นวดเท้า",
					"start_date" => "31/01/2020",
					"end_date" => "31/03/2020",
					"discount" => 15,
					"discount_type" => "PERCENT",
					"coupon_number" => "PREBOOK15",
					"description" => "description",
				],
				[
					"logo_path" => "สปาหน้า",
					"name" => "นวดกำจัดเซลลูไลท์",
					"start_date" => "31/01/2020",
					"end_date" => "31/03/2020",
					"discount" => 25,
					"discount_type" => "BATH",
					"coupon_number" => "PREBOOK25",
					"description" => "description",
				],
				[
					"logo_path" => "สปาหน้า",
					"name" => "ซาวน่า",
					"start_date" => "31/01/2020",
					"end_date" => "31/03/2020",
					"discount" => 20,
					"discount_type" => "BATH",
					"coupon_number" => "PREBOOK20",
					"description" => "description",
				],
				[
					"logo_path" => "สปาหน้า",
					"name" => "ตัดผม",
					"start_date" => "31/01/2020",
					"end_date" => "31/03/2020",
					"discount" => 50,
					"discount_type" => "PERCENT",
					"coupon_number" => "PREBOOK50",
					"description" => "description",
				],
				[
					"logo_path" => "สปาหน้า",
					"name" => "สปาเท้า",
					"start_date" => "31/01/2020",
					"end_date" => "31/03/2020",
					"discount" => 10,
					"discount_type" => "PERCENT",
					"coupon_number" => "PREBOOK10",
					"description" => "description",
				],
			];

			$promotions = [];
			foreach ($promotionData as $key => $promotion) {
				if ($key < 5) {
					$promotions[] = [
						"type" => "bubble",
						"hero" => [
							"type" => "image",
							"url" => "https://firebasestorage.googleapis.com/v0/b/trackhilight.appspot.com/o/more.png?alt=media&token=29e4d90e-465a-4ea7-b4f2-b01df46b43d6",
							"size" => "full",
							"aspectRatio" => "20:13",
							"aspectMode" => "cover",
							"action" => [
								"type" => "uri",
								"label" => "Action",
								"uri" => "line://app/1639925368-GaY5LzMn/?shop_id=1&promotion_id=1",
							]
						],
						"body" => [
							"type" => "box",
							"layout" => "vertical",
							"spacing" => "md",
							"action" => [
								"type" => "uri",
								"label" => "promotionDetail",
								"uri" => "line://app/1639925368-GaY5LzMn/?shop_id=1&promotion_id=1",
							],
							"contents" => [
								[
									"type" => "box",
									"layout" => "vertical",
									"contents" => [
										[
											"type" => "text",
											"text" => $promotion['name'],
											"size" => "lg",
											"gravity" => "center",
											"weight" => "bold",
											"color" => "#262626",
											"wrap" => true
										],
										[
											"type" => "text",
											"text" => $promotion['start_date']." - ".$promotion['end_date'],
											"size" => "sm",
											"align" => "start",
											"weight" => "bold",
											"color" => "#8C8C8C",
											"wrap" => true
										],
										[
											"type" => "text",
											"text" => "ลด ".$promotion['discount'].($promotion['discount_type'] === "PERCENT" ? "%" : "฿"),
											"size" => "md",
											"weight" => "bold",
											"color" => "#FF3B30",
											"wrap" => true
										]
									]
								],
								[
									"type" => "box",
									"layout" => "vertical",
									"contents" => [
										[
											"type" => "text",
											"text" => $promotion['coupon_number'],
											"size" => "lg",
											"align" => "center",
											"gravity" => "center",
											"weight" => "bold",
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
							"margin" => "xxl",
							"contents" => [
								[
									"type" => "text",
									"text" => $promotion['description'],
									"margin" => "xxl",
									"size" => "xs",
									"align" => "start",
									"gravity" => "bottom",
									"weight" => "regular",
									"color" => "#8C8C8C",
									"wrap" => true
								],
								[
									"type" => "spacer",
									"size" => "xxl"
								]
							]
						],
						"styles" => [
							"hero" => [
								"backgroundColor" => "#FFFFFF"
							],
							"body" => [
								"backgroundColor" => "#FFFFFF",
								"separatorColor" => "#FFFFFF"
							]
						]
					];
				}
				if ($key > 4){
					$promotions[5] = [
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
					];
				}
			}

			$promotion_json = [
				"type" => "flex",
				"altText" => "Flex Message",
				"contents" => [
					"type" => "carousel",
					"contents" => $promotions
				]
			];

			$messages = $promotion_json;
		}
		if ($event['type'] == 'message' && $event['message']['text'] == 'mybooking') {
			$mybookingData = [
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
			foreach ($mybookingData as $key => $booking) {
			$my_bookings[] = [
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
								"text" => $booking['name'],
								"margin" => "md",
								"size" => "lg",
								"align" => "start",
								"weight" => "bold",
								"color" => "#262626",
								"wrap" => true
							],
							[
								"type" => "text",
								"text" => $booking['date'].", ".$booking['time'],
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
									"text" => "x".$booking['amount'],
									"flex" => 1,
									"size" => "xs",
									"color" => "#8C8C8C",
									"wrap" => true
									],
									[
									"type" => "text",
									"text" => "฿".$booking['amount'] * $booking['price'],
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
										"text" => $booking['customer_name'],
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
									"text" => $booking['note'],
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
			// $text = $event['source']['userId'];
			// $messages = $mybooking_json;
			// $messages = [
			// 	'type' => 'text',
			// 	'text' => $text
			// ];
		}
		if ($event['type'] == 'postback') {
			$data = explode("&", $event['postback']['data']);
			if($data[0] == 'action=cancel') {
				$confirm_cancel_json = [
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
							"type" => "text",
							"text" => "คุณต้องการที่จะยกเลิกการจองใช่ไหม",
							"align" => "center",
							"color" => "#262626"
						  ]
						]
					  ],
					  "footer" => [
						"type" => "box",
						"layout" => "vertical",
						"contents" => [
						  [
							"type" => "box",
							"layout" => "horizontal",
							"contents" => [
							  [
								"type" => "button",
								"action" => [
								  "type" => "postback",
								  "label" => "Yes",
								  "text" => "Yes",
								  "data" => "action=yescancel&" .$data[1]
								],
								"color" => "#2196F3"
							  ],
							  [
								"type" => "button",
								"action" => [
								  "type" => "postback",
								  "label" => "No",
								  "text" => "No",
								  "data" => "action=nocancel&" .$data[1]
								],
								"color" => "#2196F3"
							  ]
							]
						  ]
						]
					  ]
					]
				  ];
				$messages = $confirm_cancel_json; 
			}
			if($data[0] == 'action=yescancel') {
				$cancel_json = [
					"type" => "flex",
					"altText" => "Flex Message",
					"contents" => [
					  "type" => "bubble",
					  "direction" => "ltr",
					  "header" => [
						"type" => "box",
						"layout" => "vertical",
						"flex" => 1,
						"spacing" => "none",
						"contents" => [
						  [
							"type" => "box",
							"layout" => "horizontal",
							"contents" => [
							  [
								"type" => "text",
								"text" => "#54545",
								"size" => "xl",
								"align" => "start",
								"gravity" => "center",
								"weight" => "bold",
								"color" => "#262626",
								"wrap" => true
							  ],
							  [
								"type" => "image",
								"url" => "https://firebasestorage.googleapis.com/v0/b/trackhilight.appspot.com/o/cancel.png?alt=media&token=894245ae-c725-47f9-b9b5-3f5c3e74daf0",
								"margin" => "none",
								"align" => "end",
								"gravity" => "top",
								"size" => "sm",
								"aspectRatio" => "1:1"
							  ]
							]
						  ],
						  [
							"type" => "text",
							"text" => "สปาหน้า",
							"margin" => "none",
							"size" => "lg",
							"align" => "start",
							"weight" => "bold",
							"color" => "#262626",
							"wrap" => true
						  ],
						  [
							"type" => "text",
							"text" => "16/03/2020".", "."15:11",
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
								"text" => "x2",
								"flex" => 1,
								"size" => "xs",
								"color" => "#8C8C8C",
								"wrap" => true
							  ],
							  [
								"type" => "text",
								"text" => "฿2000",
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
								"text" => "น้ำฝน",
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
								"text" => "note",
								"size" => "sm",
								"align" => "end",
								"color" => "#262626",
								"wrap" => true
							  ]
							]
						  ],
						  [
							"type" => "spacer",
							"size" => "xxl"
						  ]
						]
					  ]
					]
				  ];
				$messages = $cancel_json;
			}
			if($data[0] == 'action=nocancel') {
				$messages = [
					'type' => 'text',
					'text' => 'No'
				];
			}
		}
		// if ($event['type'] == 'postback') {
		// 	$data = explode("&", $event['postback']['data']);
		// 	if($data[0] == 'action=cancel') {
		// 		$con_json = json_decode(file_get_contents("confirmCancel.json"),true);
		// 		$con_json['contents']['header']['contents'][0]['text'] = 'ยกเลิกจริงป่ะจ้ะ'.$data[1];
		// 		$con_json['contents']['footer']['contents'][0]['contents'][0]['action']['data'] = 'action=yescancel&' .$data[1];
		// 		$con_json['contents']['footer']['contents'][0]['contents'][1]['action']['data'] = 'action=nocancel&' .$data[1];
		// 		$messages = $con_json; 
		// 	}
		// 	if($data[0] == 'action=yescancel') {
		// 		$cancel_json = json_decode(file_get_contents("cancel.json"),true);
		// 		$messages = $cancel_json;
		// 	}
		// 	if($data[0] == 'action=nocancel') {
		// 		$messages = [
		// 			'type' => 'text',
		// 			'text' => 'no no no'
		// 		];
		// 	}
		// }
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
						  "uri": "line://app/1639925368-Pqw2Qd0O/?shop_id=1"
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

		if ($event['type'] == 'message' && $event['message']['text'] == 'contact') {
			$messages = [
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
					  "type" => "text",
					  "text" => "ติดต่อพนักงาน",
					  "size" => "xl",
					  "align" => "center",
					  "weight" => "bold",
					  "color" => "#262626",
					  "wrap" => true
					]
				  ]
				],
				"body" => [
				  "type" => "box",
				  "layout" => "vertical",
				  "contents" => [
					[
					  "type" => "box",
					  "layout" => "baseline",
					  "spacing" => "md",
					  "contents" => [
						[
						  "type" => "icon",
						  "url" => "https://firebasestorage.googleapis.com/v0/b/trackhilight.appspot.com/o/phone.png?alt=media&token=a1c3cf51-c741-4321-84d5-0b27a6ae85a7"
						],
						[
						  "type" => "text",
						  "text" => "0815960912",
						  "size" => "md",
						  "color" => "#262626"
						]
					  ]
					],
					[
					  "type" => "box",
					  "layout" => "baseline",
					  "spacing" => "md",
					  "contents" => [
						[
						  "type" => "icon",
						  "url" => "https://firebasestorage.googleapis.com/v0/b/trackhilight.appspot.com/o/line.png?alt=media&token=a6280042-6cac-4f05-bfa5-00545f089aa4",
						  "aspectRatio" => "1:1"
						],
						[
						  "type" => "text",
						  "text" => "@961imuth",
						  "size" => "md",
						  "align" => "start",
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
					  "type" => "button",
					  "action" => [
						"type" => "uri",
						"label" => "โทรออก",
						"uri" => "tel:"."0815960912"
					  ],
					  "color" => "#2196F3"
					],
					[
					  "type" => "button",
					  "action" => [
						"type" => "uri",
						"label" => "พูดคุยผ่าน line",
						"uri" => "line://oaMessage/"."@961imuth"."/?"
					  ],
					  "color" => "#2196F3"
					]
				  ]
				]
			  ]
			];
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
