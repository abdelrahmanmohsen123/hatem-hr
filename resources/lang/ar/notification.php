<?php

return [
    'notification_already_read' => 'تم قراءة الإشعار بالفعل.',
    'notification_marked_as_read' => 'تم وضع علامة على الإشعار كمقروء.',
    'can_not_show_notification' => 'لا يمكن عرض الإشعار',


    // start
    'order_waiting' => 'أنا وصلت وفي انتظارك لبدء الطلب #:driver_name',
    'order_waiting_body' => 'السائق ينتظر طلبك :order_id.',

    'order_started' => 'تم بدء الطلب',
    'order_started_body' => 'السائق بدأ تنفيذ طلبك :order_id.',

    'order_recieved' => 'تم استلام الطلب',
    'order_recieved_body' => 'السائق استلم طلبك :order_id.',

    'order_delivered' => 'تم تسليم الطلب',
    'order_delivered_body' => 'السائق قام بتسليم طلبك :order_id.',

    'order_arrived' => 'وصل الطلب',
    'order_arrived_body' => 'السائق وصل إلى موقع طلبك :order_id.',

    'order_completed' => 'تم إكمال الطلب',
    'order_completed_body' => 'تم إكمال طلبك :order_id.',

    'order_in_store' => 'وصل الطلب إلى المخزن',
    'order_in_store_body' => 'طلبك :order_id. وصل إلى المخزن الآن',

    'order_out_store' => 'الطلب خرج من المخزن إلى الوجهة',
    'order_out_store_body' => 'طلبك :order_id. خرج من المخزن وسَيصل إلى الوجهة قريباً',

    'order_returned' => 'تم إرجاع الطلب',
    'order_returned_body' => 'طلبك :order_id. لم يصل وتمت إعادته',

    'order_cancelled' => 'تم إلغاء الطلب',
    'order_cancelled_body' => 'تم إلغاء طلبك :order_id.',

    'order_reported' => 'تم الإبلاغ عن الطلب',
    'order_reported_body' => 'تم الإبلاغ عن طلبك :order_id.',

    'request_update_locations' => 'طلب تحديث المواقع والسعر',
    'request_update_locations_body_driver' => 'تم تقديم طلب لتحديث المواقع لطلبك :order_id بسعر جديد #:price',
    // end
    'alert_driver_schedule_order' => 'لديك طلب مجدول سيبدأ خلال بضع ساعات',
    'alert_driver_schedule_body_order' => 'لديك طلب مجدول رقم #:order_id سيبدأ خلال :hour ساعة.',

    'order_creation' => 'تم انشاء طلب جديد',
    'order_created_body_user' => 'تم إنشاء طلبك رقم :order_id بنجاح.',
    'order_created_body_driver' => 'تم إنشاء طلب جديد لـ :category_name.',



    'new_bid_received' => 'تم استلام عرض جديد',
    'new_bid_received_body' => 'تم تقديم عرض جديد بقيمة :price على طلبك رقم :order_id.',
    'bid_accepted' => 'تم قبول العرض',
    'bid_accepted_body_user' => 'تم قبول طلبك رقم :order_id بسعر :price.',
    'bid_accepted_body_driver' => 'تم قبول عرضك على الطلب رقم :order_id بسعر :price.',

    'bid_refused' => 'تم رفض العرض',
    'bid_refused_body_user' => 'تم رفض طلبك رقم :order_id بسعر :price.',
    'bid_refused_body_driver' => 'تم رفض عرضك على الطلب رقم :order_id بسعر :price.',

    'ticket_created' => 'تم إنشاء تذكرة جديدة',
    'ticket_created_body' => 'تم إنشاء تذكرة جديدة برقم #:ticket_id.',
    'ticket_message_added' => 'تم إضافة رسالة جديدة',
    'ticket_message_added_body' => 'تم إضافة رسالة جديدة إلى التذكرة رقم #:ticket_id.',

    // Notification Messages
    'document_status_updated' => 'تم مراجعه حالة المستندات الخاصه بك',
    'document_status_updated_body' => 'تم تحديث حالة المستندات إلى :status.',


    // Withdrawal Notifications
    'withdrawal_requested' => 'تم طلب السحب',
    'withdrawal_requested_body' => 'تم تقديم طلب سحب بقيمة :amount.',
    'withdrawal_requested_admin' => 'تم طلب السحب من قبل المندوب',
    'withdrawal_requested_body_admin' => 'قام المندوب :driver_name بتقديم طلب سحب بقيمة :amount.',

    // Deposit Notifications
    'deposit_requested' => 'تم طلب الإيداع',
    'deposit_requested_body' => 'تم تقديم طلب إيداع بقيمة :amount.',
    'deposit_requested_admin' => 'تم طلب الإيداع من قبل المندوب',
    'deposit_requested_body_admin' => 'قام المندوب :driver_name بتقديم طلب إيداع بقيمة :amount.',


    'scheduled_order_reminder' => 'تذكير بالطلب المجدول',
    'scheduled_order_reminder_body_user' => 'طلبك المجدول :order_id سيبدأ في :scheduled_at.',
    'scheduled_order_reminder_body_driver' => 'لديك طلب مجدول :order_id سيبدأ في :scheduled_at.',

];
