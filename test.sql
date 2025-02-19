INSERT INTO public.movements(
	type_id,
	date_time,
	subject,
	description,
	observation, 
	support_type_id,
	support_number,
	support_date,
	user_insert_id, 
	user_update_id,
	user_edit_id,
	editing,
	created_at,
	updated_at
) VALUES (
    1,
    now()::timestamp(0) without time zone,
    'FULANO', 
	'AAAAAAA AAAAAA AAA',
	'N/O',
	1,
	'0000000001',
	now()::timestamp(0) without time zone,
	1,
	1,
	1,
	false,
	now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

INSERT INTO public.movement_details(
   	movement_id,
   	article_id,
    quantity,
    user_insert_id,
    user_update_id, 
    created_at,
    updated_at
) VALUES (
    1,
    1,
    10,
    1,
    1,
    now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

INSERT INTO public.movement_details(
   	movement_id,
   	article_id,
    quantity,
    user_insert_id,
    user_update_id, 
    created_at,
    updated_at
) VALUES (
    1,
    2,
    5,
    1,
    1,
    now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

INSERT INTO public.movement_details(
   	movement_id,
   	article_id,
    quantity,
    user_insert_id,
    user_update_id, 
    created_at,
    updated_at
) VALUES (
    1,
    3,
    8,
    1,
    1,
    now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

------------------------

INSERT INTO public.movements(
	type_id,
	date_time,
	subject,
	description,
	observation, 
	support_type_id,
	support_number,
	support_date,
	user_insert_id, 
	user_update_id,
	user_edit_id,
	editing,
	created_at,
	updated_at
) VALUES (
    2,
    now()::timestamp(0) without time zone,
    'V111111 - Cliente Uno', 
	'Email: cliente@cliente.com; Tlf: 1111111111; Edo: ANZOATEGUI; Mpio: FERNANDO DE PEÑALVER; Pqa: SAN MIGUEL;',
	'N/O',
	1,
	'0000000001',
	now()::timestamp(0) without time zone,
	1,
	1,1,
	false,
	now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

INSERT INTO public.movement_details(
   	movement_id,
   	article_id,
    quantity,
    user_insert_id,
    user_update_id, 
    created_at,
    updated_at
) VALUES (
    2,
    1,
    1,
    1,
    1,
    now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

INSERT INTO public.movement_details(
   	movement_id,
   	article_id,
    quantity,
    user_insert_id,
    user_update_id, 
    created_at,
    updated_at
) VALUES (
    2,
    2,
    2,
    1,
    1,
    now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

INSERT INTO public.movement_details(
   	movement_id,
   	article_id,
    quantity,
    user_insert_id,
    user_update_id, 
    created_at,
    updated_at
) VALUES (
    2,
    3,
    3,
    1,
    1,
    now()::timestamp(0) without time zone,
	now()::timestamp(0) without time zone
);

