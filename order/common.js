function ShowProductImageVideo(obj) {
	var img_src = "";
	var img_title = "";
	var video_id = "";
	img_src = jQuery(obj).attr("src");
	img_title = jQuery(obj).attr("title");
	img_title = img_title.trim();

	video_id = jQuery(obj).attr("id");
	video_id = video_id.trim();
	if (typeof img_src != "undefined" && img_src != "") {
		if (typeof img_title != "undefined" && img_title != "") {
			if (jQuery("#image_modal").length > 0) {
				if (
					jQuery("#image_modal").find(".modal-header").find("h4").length > 0
				) {
					jQuery("#image_modal")
						.find(".modal-header")
						.find("h4")
						.html(img_title);
				}
				if (
					jQuery("#image_modal").find(".modal-body").find(".image_video")
						.length > 0
				) {
					jQuery("#image_modal")
						.find(".modal-body")
						.find(".image_video")
						.html('<img src="' + img_src + '" class="img-fluid">');
				}
				if (
					jQuery("#image_modal")
						.find(".modal-body")
						.find(".image_column")
						.find("img").length > 0
				) {
					jQuery("#image_modal")
						.find(".modal-body")
						.find(".image_column")
						.find("img")
						.attr("src", img_src);
				}

				if (jQuery(".sub_image_row").length > 0) {
					jQuery(".sub_image_row").each(function () {
						jQuery(this).remove();
					});
				}

				if (jQuery(obj).parent().find('input[name="sub_images"]').length > 0) {
					if (
						jQuery("#image_modal").find(".modal-body").find(".image_video")
							.length > 0
					) {
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".image_video")
							.attr("colspan", "4");
					}
					jQuery(obj)
						.parent()
						.find('input[name="sub_images"]')
						.each(function () {
							var sub_image = "";
							sub_image = jQuery(this).val();
							sub_image = jQuery.trim(sub_image);
							if (
								typeof sub_image != "undefined" &&
								sub_image != null &&
								sub_image != ""
							) {
								if (
									jQuery("#image_modal")
										.find(".modal-body")
										.find(".image_column").length > 0
								) {
									jQuery("#image_modal")
										.find(".modal-body")
										.find(".image_column:last")
										.after(
											'<td class="text-center sub_image_row image_column" style="width: 25%; height: 100px; padding: 5px; cursor: pointer;"><img src="' +
												sub_image +
												'" class="img-fluid" alt="Crackers" title="Crackers" onClick="Javascript:ShowProductImage(this);"></td>'
										);
								}
							}
						});
				}

				if (typeof video_id != "undefined" && video_id != "") {
					if (
						jQuery("#image_modal").find(".modal-body").find(".video_column")
							.length > 0
					) {
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".video_column")
							.css({ display: "table-cell" });
					}
					if (
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".video_column")
							.find("img").length > 0
					) {
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".video_column")
							.find("img")
							.attr("id", video_id);
					}
				} else {
					if (
						jQuery("#image_modal").find(".modal-body").find(".video_column")
							.length > 0
					) {
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".video_column")
							.css({ display: "none" });
					}
					if (
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".video_column")
							.find("img").length > 0
					) {
						jQuery("#image_modal")
							.find(".modal-body")
							.find(".video_column")
							.find("img")
							.attr("id", "");
					}
				}

				if (jQuery(".image_video_popup").length > 0) {
					jQuery(".image_video_popup").trigger("click");
				}
			}
		}
	}
}
function ShowProductImage(obj) {
	var img_src = "";
	img_src = jQuery(obj).attr("src");
	if (typeof img_src != "undefined" && img_src != "") {
		if (jQuery("#image_modal").length > 0) {
			if (
				jQuery("#image_modal").find(".modal-body").find(".image_video").length >
				0
			) {
				jQuery("#image_modal")
					.find(".modal-body")
					.find(".image_video")
					.html('<img src="' + img_src + '" class="img-fluid">');
			}
		}
	}
}
function ShowProductVideo(obj) {
	var video_id = "";
	video_id = jQuery(obj).attr("id");
	video_id = video_id.trim();
	if (typeof video_id != "undefined" && video_id != "") {
		if (
			jQuery("#image_modal").find(".modal-body").find(".image_video").length > 0
		) {
			jQuery("#image_modal")
				.find(".modal-body")
				.find(".image_video")
				.html(
					'<iframe width="100%" height="300" src="https://www.youtube.com/embed/' +
						video_id +
						'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
				);
		}
	}
}

function CloseImageVideoPopup() {
	if (
		jQuery("#image_modal").find(".modal-body").find(".image_video").length > 0
	) {
		jQuery("#image_modal").find(".modal-body").find(".image_video").html("");
	}
	if (
		jQuery("#image_modal").find(".modal-header").find("button.close").length > 0
	) {
		jQuery("#image_modal")
			.find(".modal-header")
			.find("button.close")
			.trigger("click");
	}
}

function CheckDecimal(check_number) {
	if (check_number != "" && check_number != 0) {
		var decimal = "";
		var numbers = "";
		numbers = check_number.toString().split(".");
		if (typeof numbers[1] != "undefined") {
			decimal = numbers[1];
			if (decimal != "" && decimal != 00) {
				if (decimal.length == 1) {
					decimal = decimal + "0";
					check_number = numbers[0] + "." + decimal;
				}
				if (decimal.length > 2) {
					check_number = check_number.toFixed(2);
				}
			} else {
				check_number = numbers[0] + ".00";
			}
		}
	}
	return check_number;
}

function changeCity(state) {
	if (jQuery(".minimum_order_amount_cover").length) {
		jQuery(".minimum_order_amount_cover").addClass("d-none");
	}
	if (jQuery(".minimum_order_amount").length) {
		jQuery(".minimum_order_amount").html("");
	}
	if (jQuery(".packing_charges_cover").length) {
		jQuery(".packing_charges_cover").addClass("d-none");
	}
	if (jQuery(".packing_charges").length) {
		jQuery(".packing_charges").html("");
	}

	var post_url = "pricelist_changes.php?diplay_city_by_state=" + state;
	jQuery.ajax({
		url: post_url,
		success: function (result) {
			if (jQuery("#city_list").length > 0) {
				jQuery("#city_list").html("");
				jQuery("#city_list").html(result);

				var post_url =
					"pricelist_changes.php?minimum_order_amount_packing_state=" + state;
				jQuery.ajax({
					url: post_url,
					success: function (result) {
						if (typeof result != "undefined" && result != "") {
							//console.log(result);
							result = JSON.parse(result);
							//console.log(result['minimum_order_amount']+' / '+result['packing_charges']);
							if (
								typeof result["minimum_order_amount"] != "undefined" &&
								result["minimum_order_amount"] != "" &&
								result["minimum_order_amount"] != 0
							) {
								if (jQuery(".minimum_order_amount").length) {
									jQuery(".minimum_order_amount").html("");
									result["minimum_order_amount"] = CheckDecimal(
										result["minimum_order_amount"]
									);
									jQuery(".minimum_order_amount").html(
										"Rs." + result["minimum_order_amount"]
									);
									if (jQuery(".minimum_order_amount_cover").length) {
										jQuery(".minimum_order_amount_cover").removeClass("d-none");
									}
								}
							}
							if (
								typeof result["packing_charges"] != "undefined" &&
								result["packing_charges"] != "" &&
								result["packing_charges"] != 0
							) {
								if (jQuery(".packing_charges").length) {
									jQuery(".packing_charges").html("");
									jQuery(".packing_charges").html(result["packing_charges"]);
									if (jQuery(".packing_charges_cover").length) {
										jQuery(".packing_charges_cover").removeClass("d-none");
									}
								}
							}
						}
						calOverallTotal();
					},
				});
			}
		},
	});
}

function SendOtp(event) {
	event.preventDefault();
	var form_name = "order_form";

	jQuery.ajax({
		url: "send_otp.php",
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		success: function (data) {
			console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery("span.infos").length > 0) {
				jQuery("span.infos").remove();
			}
			if (jQuery(".valid_error").length > 0) {
				jQuery(".valid_error").remove();
			}
			if (jQuery("div.alert").length > 0) {
				jQuery("div.alert").remove();
			}

			if (x.number == "1") {
				jQuery(".otp_receive_mobile_number").html(x.otp_receive_mobile_number);
				$("#otp_modal").modal("show");

				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				setTimeout(function () {
					if (
						typeof x.otp_send_date != "undefined" &&
						x.otp_send_date != null &&
						x.otp_send_date != ""
					) {
						if (jQuery(".otp_send_date").length > 0) {
							jQuery(".otp_send_date").html(x.otp_send_date);
						}
						if (
							typeof x.otp_receive_mobile_number != "undefined" &&
							x.otp_receive_mobile_number != null &&
							x.otp_receive_mobile_number != ""
						) {
							if (jQuery(".otp_receive_mobile_number").length > 0) {
								jQuery(".otp_receive_mobile_number").html(
									x.otp_receive_mobile_number
								);
							}
							if (
								typeof x.otp_number != "undefined" &&
								x.otp_number != null &&
								x.otp_number != ""
							) {
								if (jQuery(".otp_receive_mobile_number").length > 0) {
									jQuery(".otp_receive_mobile_number").attr("id", x.otp_number);
								}
							}
							if (jQuery(".digit-group").length > 0) {
								jQuery(".digit-group").attr("id", "1");
							}
							if (jQuery(".otp_modal_button").length > 0) {
								jQuery(".otp_modal_button").trigger("click");
							}
						}
					} else if (typeof x.order_id != "undefined" && x.order_id != "") {
						var verify_enquiry_customer_id = "";
						if (jQuery('input[name="verify_enquiry_customer_id"]').length > 0) {
							verify_enquiry_customer_id = jQuery(
								'input[name="verify_enquiry_customer_id"]'
							).val();
						}
						var device_layout = "";
						if (jQuery('input[name="device_layout"]').length > 0) {
							device_layout = jQuery('input[name="device_layout"]').val();
						}
						if (
							typeof verify_enquiry_customer_id != "undefined" &&
							verify_enquiry_customer_id != ""
						) {
							if (typeof device_layout != "undefined" && device_layout != "") {
								window.location =
									"enquiry.php?verify_enquiry_customer_id=" +
									verify_enquiry_customer_id +
									"&device_layout=" +
									device_layout;
							}
						} else {
							window.location = "order1.php?view_order_id=" + x.order_id;
						}
					}
				}, 1000);
			}

			if (x.number == "2") {
				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}

			if (x.number == "3") {
				jQuery('form[name="' + form_name + '"]').append(
					'<div class="valid_error"> <script type="text/javascript"> ' +
						x.msg +
						" </script> </div>"
				);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		},
	});
}

function SaveOrder(event) {
	event.preventDefault();
	var form_name = "order_form";
	SubmitOrder(form_name);
}

function SubmitOrder(form_name) {
	if (jQuery("div.alert").length > 0) {
		jQuery("div.alert").remove();
	}
	if (jQuery("span.infos").length > 0) {
		jQuery("span.infos").each(function () {
			jQuery(this).remove();
		});
	}
	jQuery('form[name="' + form_name + '"]')
		.find(".row:first")
		.before(
			'<div class="alert alert-danger mb-3"> <button type="button" class="close" data-dismiss="alert">&times;</button> Processing </div>'
		);
	if (
		jQuery('form[name="' + form_name + '"]').find(".submit_button").length > 0
	) {
		jQuery('form[name="' + form_name + '"]')
			.find(".submit_button")
			.attr("disabled", true);
	}
	if (jQuery(".grid_products").length > 0) {
		jQuery("#navigation").animate(
			{
				scrollTop: jQuery("body").offset().top,
			},
			500
		);
	} else {
		jQuery("html, body").animate(
			{
				scrollTop: jQuery('form[name="' + form_name + '"]').offset().top,
			},
			500
		);
	}

	jQuery.ajax({
		url: "pricelist_changes.php",
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		success: function (data) {
			//$("#otp_modal").modal("show");
			console.log(data, "Demo");
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			console.log(x, "Logoed");

			if (jQuery("span.infos").length > 0) {
				jQuery("span.infos").remove();
			}
			if (jQuery(".valid_error").length > 0) {
				jQuery(".valid_error").remove();
			}
			if (jQuery("div.alert").length > 0) {
				jQuery("div.alert").remove();
			}

			if (x.number == "1") {
				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				setTimeout(function () {
					if (
						typeof x.otp_send_date != "undefined" &&
						x.otp_send_date != null &&
						x.otp_send_date != ""
					) {
						if (jQuery(".otp_send_date").length > 0) {
							jQuery(".otp_send_date").html(x.otp_send_date);
						}
						if (
							typeof x.otp_receive_mobile_number != "undefined" &&
							x.otp_receive_mobile_number != null &&
							x.otp_receive_mobile_number != ""
						) {
							if (jQuery(".otp_receive_mobile_number").length > 0) {
								jQuery(".otp_receive_mobile_number").html(
									x.otp_receive_mobile_number
								);
							}
							if (
								typeof x.otp_number != "undefined" &&
								x.otp_number != null &&
								x.otp_number != ""
							) {
								if (jQuery(".otp_receive_mobile_number").length > 0) {
									jQuery(".otp_receive_mobile_number").attr("id", x.otp_number);
								}
							}
							if (jQuery(".digit-group").length > 0) {
								jQuery(".digit-group").attr("id", "1");
							}
							if (jQuery(".otp_modal_button").length > 0) {
								jQuery(".otp_modal_button").trigger("click");
							}
						}
					} else if (typeof x.order_id != "undefined" && x.order_id != "") {
						var verify_enquiry_customer_id = "";
						if (jQuery('input[name="verify_enquiry_customer_id"]').length > 0) {
							verify_enquiry_customer_id = jQuery(
								'input[name="verify_enquiry_customer_id"]'
							).val();
						}
						var device_layout = "";
						if (jQuery('input[name="device_layout"]').length > 0) {
							device_layout = jQuery('input[name="device_layout"]').val();
						}
						if (
							typeof verify_enquiry_customer_id != "undefined" &&
							verify_enquiry_customer_id != ""
						) {
							if (typeof device_layout != "undefined" && device_layout != "") {
								window.location =
									"enquiry.php?verify_enquiry_customer_id=" +
									verify_enquiry_customer_id +
									"&device_layout=" +
									device_layout;
							}
						} else {
							window.location = "order1.php?view_order_id=" + x.order_id;
						}
					}
				}, 1000);
			}

			if (x.number == "2") {
				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}

			if (x.number == "3") {
				jQuery('form[name="' + form_name + '"]').append(
					'<div class="valid_error"> <script type="text/javascript"> ' +
						x.msg +
						" </script> </div>"
				);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		},
	});
}

function EnquiryCustomer(event) {
	event.preventDefault();
	var form_name = "enquiry_form";
	SubmitEnquiryCustomer(form_name);
}

function SubmitEnquiryCustomer(form_name) {
	if (jQuery("div.alert").length > 0) {
		jQuery("div.alert").remove();
	}
	if (jQuery("span.infos").length > 0) {
		jQuery("span.infos").each(function () {
			jQuery(this).remove();
		});
	}
	jQuery('form[name="' + form_name + '"]')
		.find(".row:first")
		.before(
			'<div class="alert alert-danger mb-3"> <button type="button" class="close" data-dismiss="alert">&times;</button> Processing </div>'
		);
	if (
		jQuery('form[name="' + form_name + '"]').find(".submit_button").length > 0
	) {
		jQuery('form[name="' + form_name + '"]')
			.find(".submit_button")
			.attr("disabled", true);
	}
	jQuery("html, body").animate(
		{
			scrollTop: jQuery('form[name="' + form_name + '"]').offset().top,
		},
		500
	);

	jQuery.ajax({
		url: "pricelist_changes.php",
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		success: function (data) {
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery("span.infos").length > 0) {
				jQuery("span.infos").remove();
			}
			if (jQuery(".valid_error").length > 0) {
				jQuery(".valid_error").remove();
			}
			if (jQuery("div.alert").length > 0) {
				jQuery("div.alert").remove();
			}

			if (x.number == "1") {
				if (jQuery('input[name="customer_name"]').length > 0) {
					jQuery('input[name="customer_name"]').val("");
				}
				if (jQuery('input[name="customer_mobile_number"]').length > 0) {
					jQuery('input[name="customer_mobile_number"]').val("");
				}

				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
				/*setTimeout(function(){
                    if(typeof x.customer_id != "undefined" && x.customer_id != "") {
                        window.location = "enquiry.php?enquiry_customer_id="+x.customer_id;
                    }
                }, 2000);*/
			}

			if (x.number == "2") {
				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}

			if (x.number == "3") {
				jQuery('form[name="' + form_name + '"]').append(
					'<div class="valid_error"> <script type="text/javascript"> ' +
						x.msg +
						" </script> </div>"
				);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		},
	});
}

function VerifyEnquiryCustomer(event) {
	event.preventDefault();
	var form_name = "verificatiaon_form";
	SubmitVerifyEnquiryCustomer(form_name);
}

function SubmitVerifyEnquiryCustomer(form_name) {
	if (jQuery("div.alert").length > 0) {
		jQuery("div.alert").remove();
	}
	if (jQuery("span.infos").length > 0) {
		jQuery("span.infos").each(function () {
			jQuery(this).remove();
		});
	}
	jQuery('form[name="' + form_name + '"]')
		.find(".row:first")
		.before(
			'<div class="alert alert-danger mb-3"> <button type="button" class="close" data-dismiss="alert">&times;</button> Processing </div>'
		);
	if (
		jQuery('form[name="' + form_name + '"]').find(".submit_button").length > 0
	) {
		jQuery('form[name="' + form_name + '"]')
			.find(".submit_button")
			.attr("disabled", true);
	}
	jQuery("html, body").animate(
		{
			scrollTop: jQuery('form[name="' + form_name + '"]').offset().top,
		},
		500
	);

	jQuery.ajax({
		url: "pricelist_changes.php",
		type: "post",
		async: true,
		data: jQuery('form[name="' + form_name + '"]').serialize(),
		dataType: "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		success: function (data) {
			//console.log(data);
			try {
				var x = JSON.parse(data);
			} catch (e) {
				return false;
			}
			//console.log(x);

			if (jQuery("span.infos").length > 0) {
				jQuery("span.infos").remove();
			}
			if (jQuery(".valid_error").length > 0) {
				jQuery(".valid_error").remove();
			}
			if (jQuery("div.alert").length > 0) {
				jQuery("div.alert").remove();
			}

			if (x.number == "1") {
				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				setTimeout(function () {
					if (typeof x.customer_id != "undefined" && x.customer_id != "") {
						var window_width = jQuery(window).width();
						var device_layout;
						if (window_width >= 992) {
							device_layout = "desktop";
						}
						if (window_width >= 768 && window_width <= 991) {
							device_layout = "tablet";
						}
						if (window_width <= 767) {
							device_layout = "mobile";
						}
						window.location =
							"enquiry.php?verify_enquiry_customer_id=" +
							x.customer_id +
							"&device_layout=" +
							device_layout;
					}
				}, 1000);
			}

			if (x.number == "2") {
				jQuery('form[name="' + form_name + '"]')
					.find(".row:first")
					.before(
						'<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button> ' +
							x.msg +
							" </div>"
					);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}

			if (x.number == "3") {
				jQuery('form[name="' + form_name + '"]').append(
					'<div class="valid_error"> <script type="text/javascript"> ' +
						x.msg +
						" </script> </div>"
				);
				if (
					jQuery('form[name="' + form_name + '"]').find(".submit_button")
						.length > 0
				) {
					jQuery('form[name="' + form_name + '"]')
						.find(".submit_button")
						.attr("disabled", false);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);
		},
	});
}

function TogglePromotionCode() {
	if (jQuery(".promotion_code_cover").length > 0) {
		jQuery(".promotion_code_cover").toggle();
	}
}
function ApplyPromotionCode() {
	if (jQuery(".total_cover").length > 0) {
		if (jQuery(".total_cover").hasClass("d-none") == false) {
			jQuery(".total_cover").addClass("d-none");
		}
	}
	if (jQuery(".total").length > 0) {
		jQuery(".total").html("");
	}
	if (jQuery(".promotion_code_error").length > 0) {
		jQuery(".promotion_code_error").html("");
	}
	if (jQuery(".promotion_code_discount_value").length > 0) {
		jQuery(".promotion_code_discount_value").html("");
	}

	var promotion_code = "";
	if (jQuery('input[name="promotion_code"]').length > 0) {
		promotion_code = jQuery('input[name="promotion_code"]').val();
		promotion_code = jQuery.trim(promotion_code);

		if (
			typeof promotion_code != "undefined" &&
			promotion_code != null &&
			promotion_code != ""
		) {
			var sub_total = "";
			if (jQuery(".sub_total").length > 0) {
				sub_total = jQuery(".sub_total").html();
				sub_total = sub_total.replace("Rs.", "");
				sub_total = jQuery.trim(sub_total);
				if (
					typeof sub_total != "undefined" &&
					sub_total != null &&
					sub_total != ""
				) {
					if (price_regex.test(sub_total) == true) {
						var post_url =
							"pricelist_changes.php?check_promotion_code=" +
							promotion_code +
							"&sub_total=" +
							sub_total;
						jQuery.ajax({
							url: post_url,
							success: function (result) {
								result = jQuery.trim(result);
								var price_regex = /^(\d*\.)?\d+$/;
								if (price_regex.test(result) == true) {
									promotion_code_discount_value = result;
									if (jQuery(".promotion_code_discount_value").length > 0) {
										jQuery(".promotion_code_discount_value").html(
											"Rs. " + promotion_code_discount_value
										);
									}
									sub_total =
										parseFloat(sub_total) -
										parseFloat(promotion_code_discount_value);
									sub_total = CheckDecimal(sub_total);
									if (jQuery(".total_cover").length > 0) {
										if (jQuery(".total_cover").hasClass("d-none") == true) {
											jQuery(".total_cover").removeClass("d-none");
										}
									}
									if (jQuery(".total").length > 0) {
										jQuery(".total").html("Rs. " + sub_total);
									}
									calOverallTotal();
								} else {
									if (jQuery(".promotion_code_error").length > 0) {
										jQuery(".promotion_code_error").html(result);
									}
									calOverallTotal();
								}
							},
						});
					}
				}
			}
		}
	}
}
