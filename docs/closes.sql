--
/*
CREATE TABLE public.cierre_diario (
    id integer NOT NULL,
    id_presentacion integer NOT NULL,
    cantidad_entrante integer DEFAULT 0 NOT NULL,
    cantidad_saliente integer DEFAULT 0 NOT NULL,
    cantidad_reverso_entrante integer DEFAULT 0 NOT NULL,
    cantidad_reverso_saliente integer DEFAULT 0 NOT NULL,
    cierre_dia date NOT NULL,
    id_user_insert integer DEFAULT 1 NOT NULL,
    date_insert date DEFAULT ('now'::text)::date NOT NULL,
    time_insert time(0) without time zone DEFAULT ('now'::text)::time without time zone NOT NULL
);

CREATE TABLE public.cierre_mensual (
    id integer NOT NULL,
    id_presentacion integer NOT NULL,
    cantidad_entrante integer DEFAULT 0 NOT NULL,
    cantidad_saliente integer DEFAULT 0 NOT NULL,
    cantidad_reverso_entrante integer DEFAULT 0 NOT NULL,
    cantidad_reverso_saliente integer DEFAULT 0 NOT NULL,
    cierre_mes integer NOT NULL,
    id_user_insert integer DEFAULT 1 NOT NULL,
    date_insert date DEFAULT ('now'::text)::date NOT NULL,
    time_insert time(0) without time zone DEFAULT ('now'::text)::time without time zone NOT NULL
);
--
CREATE TABLE public.cierre_anual (
    id integer NOT NULL,
    id_presentacion integer NOT NULL,
    cantidad_entrante integer DEFAULT 0 NOT NULL,
    cantidad_saliente integer DEFAULT 0 NOT NULL,
    cantidad_reverso_entrante integer DEFAULT 0 NOT NULL,
    cantidad_reverso_saliente integer DEFAULT 0 NOT NULL,
    cierre_ano integer NOT NULL,
    id_user_insert integer DEFAULT 1 NOT NULL,
    date_insert date DEFAULT ('now'::text)::date NOT NULL,
    time_insert time(0) without time zone DEFAULT ('now'::text)::time without time zone NOT NULL
);

php artisan module:make-migration create_daily_closings Store
php artisan module:make-model DailyClosing Store

php artisan module:make-migration create_monthly_closings Store 
php artisan module:make-model MonthlyClosing Store

php artisan module:make-migration create_annual_closings Store 
php artisan module:make-model AnnualClosing Store

--
CREATE TABLE public.soporte_tipo (
    id integer NOT NULL,
    nombre character varying,
    id_movimiento_tipo integer
);

--

CREATE VIEW public.view_existencia_movimiento AS
 SELECT DISTINCT b.categoria,
    b.producto,
    b.marca,
    a.id_presentacion,
    ( SELECT public.view_presentacion_despliegue(a.id_presentacion) AS view_presentacion_despliegue) AS presentacion,
        CASE
            WHEN (e.cantidad IS NULL) THEN (0)::bigint
            ELSE e.cantidad
        END AS entradas,
        CASE
            WHEN (s.cantidad IS NULL) THEN (0)::bigint
            ELSE s.cantidad
        END AS salidas,
        CASE
            WHEN (re.cantidad IS NULL) THEN (0)::bigint
            ELSE re.cantidad
        END AS reverso_entradas,
        CASE
            WHEN (rs.cantidad IS NULL) THEN (0)::bigint
            ELSE rs.cantidad
        END AS reverso_salidas,
    ((COALESCE(e.cantidad, (0)::bigint) - COALESCE(re.cantidad, (0)::bigint)) - (COALESCE(s.cantidad, (0)::bigint) - COALESCE(rs.cantidad, (0)::bigint))) AS total
   FROM (((((public.movimiento_aux a
     JOIN public.view_presentacion b ON ((a.id_presentacion = b.id)))
     LEFT JOIN ( SELECT view_presentacion_cantidad_entrada.id_presentacion,
            view_presentacion_cantidad_entrada.cantidad
           FROM public.view_presentacion_cantidad_entrada) e ON ((a.id_presentacion = e.id_presentacion)))
     LEFT JOIN ( SELECT view_presentacion_cantidad_salida.id_presentacion,
            view_presentacion_cantidad_salida.cantidad
           FROM public.view_presentacion_cantidad_salida) s ON ((a.id_presentacion = s.id_presentacion)))
     LEFT JOIN ( SELECT view_presentacion_cantidad_reverso_entrada.id_presentacion,
            view_presentacion_cantidad_reverso_entrada.cantidad
           FROM public.view_presentacion_cantidad_reverso_entrada) re ON ((a.id_presentacion = re.id_presentacion)))
     LEFT JOIN ( SELECT view_presentacion_cantidad_reverso_salida.id_presentacion,
            view_presentacion_cantidad_reverso_salida.cantidad
           FROM public.view_presentacion_cantidad_reverso_salida) rs ON ((a.id_presentacion = rs.id_presentacion)))
  WHERE (a.cierre_fec IS NULL);
  
  
  --
  
  CREATE VIEW public.view_existencia AS
 SELECT alias.categoria,
    alias.producto,
    alias.marca,
    alias.id_presentacion,
    alias.presentacion,
    sum(alias.entradas) AS entradas,
    sum(alias.salidas) AS salidas,
    sum(alias.reverso_entradas) AS reverso_entradas,
    sum(alias.reverso_salidas) AS reverso_salidas,
    sum(alias.total) AS total
   FROM ( SELECT view_existencia_movimiento.categoria,
            view_existencia_movimiento.producto,
            view_existencia_movimiento.marca,
            view_existencia_movimiento.id_presentacion,
            view_existencia_movimiento.presentacion,
            view_existencia_movimiento.entradas,
            view_existencia_movimiento.salidas,
            view_existencia_movimiento.reverso_entradas,
            view_existencia_movimiento.reverso_salidas,
            view_existencia_movimiento.total
           FROM public.view_existencia_movimiento
        UNION ALL
         SELECT view_existencia_cierre_diario.categoria,
            view_existencia_cierre_diario.producto,
            view_existencia_cierre_diario.marca,
            view_existencia_cierre_diario.id_presentacion,
            view_existencia_cierre_diario.presentacion,
            view_existencia_cierre_diario.entradas,
            view_existencia_cierre_diario.salidas,
            view_existencia_cierre_diario.reverso_entradas,
            view_existencia_cierre_diario.reverso_salidas,
            view_existencia_cierre_diario.total
           FROM public.view_existencia_cierre_diario) alias
  GROUP BY alias.categoria, alias.producto, alias.marca, alias.id_presentacion, alias.presentacion;

---

/*-CREATE VIEW public.view_cierre_mov_fec_presentacion AS
 -SELECT DISTINCT b.movimiento_fec,
 -   a.id_presentacion
 -  FROM (public.movimiento_aux a
 -    LEFT JOIN public.movimiento b ON ((a.id_movimiento = b.id)))
 - WHERE ((a.cierre_fec IS NULL) AND (b.cierre_fec IS NULL))
 - ORDER BY b.movimiento_fec, a.id_presentacion;*/
  
 CREATE VIEW public.view_clousure_mov_date_time_article AS
 SELECT DISTINCT b.date_time,
    a.article_id
   FROM (public.movement_details a
     LEFT JOIN public.movements b ON ((a.movement_id = b.id)))
  WHERE ((a.close IS NULL) AND (b.close IS NULL))
  ORDER BY b.date_time, a.article_id;
  
--
 -- CREATE VIEW public.view_cierre_pre_insert_aux AS
 --SELECT b.movimiento_fec,
 --   a.id_presentacion,
 --   sum(a.cantidad) AS sum,
 --   b.id_movimiento_tipo
 --  FROM (public.movimiento_aux a
 --    JOIN public.movimiento b ON ((a.id_movimiento = b.id)))
 -- WHERE ((a.cierre_fec IS NULL) AND (b.cierre_fec IS NULL))
 -- GROUP BY b.movimiento_fec, a.id_presentacion, b.id_movimiento_tipo
 -- ORDER BY b.movimiento_fec, a.id_presentacion, b.id_movimiento_tipo;  
  
 CREATE VIEW public.view_closure_pre_insert_aux AS 
   SELECT b.date_time,
    a.article_id,
    sum(a.quantity) AS sum,
    b.type_id
   FROM (public.movement_details a
     JOIN public.movements b ON ((a.movement_id = b.id)))
  WHERE ((a.close IS NULL) AND (b.close IS NULL))
  GROUP BY b.date_time, a.article_id, b.type_id
  ORDER BY b.date_time, a.article_id, b.type_id;

--

-- CREATE VIEW public.view_cierre_pre_insert AS
-- SELECT a.movimiento_fec,
--     a.id_presentacion,
--         CASE
--             WHEN (sum(b.sum) IS NULL) THEN ((0)::bigint)::numeric
--             ELSE sum(b.sum)
--         END AS cantidad_entrante,
--         CASE
--             WHEN (sum(c.sum) IS NULL) THEN ((0)::bigint)::numeric
--             ELSE sum(c.sum)
--         END AS cantidad_saliente,
--         CASE
--             WHEN (sum(d.sum) IS NULL) THEN ((0)::bigint)::numeric
--             ELSE sum(d.sum)
--         END AS cantidad_reverso_entrante,
--         CASE
--             WHEN (sum(e.sum) IS NULL) THEN ((0)::bigint)::numeric
--             ELSE sum(e.sum)
--         END AS cantidad_reverso_saliente
--    FROM ((((public.view_cierre_mov_fec_presentacion a
--      LEFT JOIN public.view_cierre_pre_insert_aux b ON (((a.id_presentacion = b.id_presentacion) AND (b.id_movimiento_tipo = 1) AND (a.movimiento_fec = b.movimiento_fec))))
--      LEFT JOIN public.view_cierre_pre_insert_aux c ON (((a.id_presentacion = c.id_presentacion) AND (c.id_movimiento_tipo = 2) AND (a.movimiento_fec = c.movimiento_fec))))
--      LEFT JOIN public.view_cierre_pre_insert_aux d ON (((a.id_presentacion = d.id_presentacion) AND (d.id_movimiento_tipo = 3) AND (a.movimiento_fec = d.movimiento_fec))))
--      LEFT JOIN public.view_cierre_pre_insert_aux e ON (((a.id_presentacion = e.id_presentacion) AND (e.id_movimiento_tipo = 4) AND (a.movimiento_fec = e.movimiento_fec))))
--   GROUP BY a.movimiento_fec, a.id_presentacion
--   ORDER BY a.movimiento_fec, a.id_presentacion;
  
  
 CREATE VIEW public.view_closure_pre_insert AS
 SELECT a.date_time,
    a.article_id,
        CASE
            WHEN (sum(b.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(b.sum)
        END AS quantity_input,
        CASE
            WHEN (sum(c.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(c.sum)
        END AS quantity_output,
        CASE
            WHEN (sum(d.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(d.sum)
        END AS quantity_reverse_input,
        CASE
            WHEN (sum(e.sum) IS NULL) THEN ((0)::bigint)::numeric
            ELSE sum(e.sum)
        END AS quantity_reverse_output
   FROM ((((public.view_clousure_mov_date_time_article a
     LEFT JOIN public.view_closure_pre_insert_aux b ON (((a.article_id = b.article_id) AND (b.type_id = 1) AND (a.date_time = b.date_time))))
     LEFT JOIN public.view_closure_pre_insert_aux c ON (((a.article_id = c.article_id) AND (c.type_id = 2) AND (a.date_time = c.date_time))))
     LEFT JOIN public.view_closure_pre_insert_aux d ON (((a.article_id = d.article_id) AND (d.type_id = 3) AND (a.date_time = d.date_time))))
     LEFT JOIN public.view_closure_pre_insert_aux e ON (((a.article_id = e.article_id) AND (e.type_id = 4) AND (a.date_time = e.date_time))))
  GROUP BY a.date_time, a.article_id
  ORDER BY a.date_time, a.article_id;
  
  ---

 --CREATE VIEW public.view_presentacion_cantidad_entrada AS
 --SELECT a.id_presentacion,
 --   sum(a.cantidad) AS cantidad
 --  FROM (public.movimiento_aux a
 --    JOIN public.movimiento b ON (((a.id_movimiento = b.id) AND (b.cierre_fec IS NULL))))
 -- WHERE (b.id_movimiento_tipo = 1)
 -- GROUP BY a.id_presentacion;   
  
CREATE VIEW public.view_article_quantity_input AS
   SELECT a.article_id,
    sum(a.quantity) AS quantity
   FROM (public.movement_details a
     JOIN public.movements b ON (((a.movement_id = b.id) AND (b.close IS NULL))))
  WHERE (b.type_id = 1)
  GROUP BY a.article_id;
  
  --
  
  CREATE VIEW public.view_presentacion_cantidad_reverso_entrada AS
 SELECT a.id_presentacion,
    sum(a.cantidad) AS cantidad
   FROM (public.movimiento_aux a
     JOIN public.movimiento b ON (((a.id_movimiento = b.id) AND (b.cierre_fec IS NULL))))
  WHERE (b.id_movimiento_tipo = 3)
  GROUP BY a.id_presentacion;

--

CREATE VIEW public.view_presentacion_cantidad_reverso_salida AS
 SELECT a.id_presentacion,
    sum(a.cantidad) AS cantidad
   FROM (public.movimiento_aux a
     JOIN public.movimiento b ON (((a.id_movimiento = b.id) AND (b.cierre_fec IS NULL))))
  WHERE (b.id_movimiento_tipo = 4)
  GROUP BY a.id_presentacion;

--

CREATE VIEW public.view_presentacion_cantidad_salida AS
 SELECT a.id_presentacion,
    sum(a.cantidad) AS cantidad
   FROM (public.movimiento_aux a
     JOIN public.movimiento b ON (((a.id_movimiento = b.id) AND (b.cierre_fec IS NULL))))
  WHERE (b.id_movimiento_tipo = 2)
  GROUP BY a.id_presentacion;
  
  
--

/*--CREATE VIEW public.view_existencia_cierre_diario AS
 --SELECT b.categoria,
 --   b.producto,
 --   b.marca,
 --   a.id_presentacion,
 --   ( SELECT public.view_presentacion_despliegue(a.id_presentacion) AS view_presentacion_despliegue) AS presentacion,
 --       CASE
 --           WHEN (a.cantidad_entrante IS NULL) THEN 0
 --           ELSE a.cantidad_entrante
 --       END AS entradas,
 --       CASE
 --           WHEN (a.cantidad_saliente IS NULL) THEN 0
 --           ELSE a.cantidad_saliente
 --       END AS salidas,
 --       CASE
 --           WHEN (a.cantidad_reverso_entrante IS NULL) THEN 0
 --           ELSE a.cantidad_reverso_entrante
 --       END AS reverso_entradas,
 --       CASE
 --           WHEN (a.cantidad_reverso_saliente IS NULL) THEN 0
 --           ELSE a.cantidad_reverso_saliente
 --       END AS reverso_salidas,
 --   ((COALESCE(a.cantidad_entrante, 0) - COALESCE(a.cantidad_reverso_entrante, 0)) - (COALESCE(a.cantidad_saliente, 0) - COALESCE(a.cantidad_reverso_saliente, 0))) AS total
 --  FROM (public.cierre_diario a
 --    JOIN public.view_presentacion b ON ((a.id_presentacion = b.id)))
 -- WHERE true;*/

CREATE VIEW public.view_existence_daily_closing AS
 SELECT a.article_id,
        CASE
            WHEN (a.quantity_input IS NULL) THEN 0
            ELSE a.quantity_input
        END AS entradas,
        CASE
            WHEN (a.quantity_output IS NULL) THEN 0
            ELSE a.quantity_output
        END AS salidas,
        CASE
            WHEN (a.quantity_reverse_input IS NULL) THEN 0
            ELSE a.quantity_reverse_input
        END AS reverso_entradas,
        CASE
            WHEN (a.quantity_reverse_output IS NULL) THEN 0
            ELSE a.quantity_reverse_output
        END AS reverso_salidas,
    ((COALESCE(a.quantity_input, 0) - COALESCE(a.quantity_reverse_input, 0)) - (COALESCE(a.quantity_output, 0) - COALESCE(a.quantity_reverse_output, 0))) AS total
   FROM public.close_days a
  WHERE true;
  
  
  CREATE VIEW public.view_existence_close_days AS
 SELECT a.article_id,
        CASE
            WHEN (a.quantity_input IS NULL) THEN 0
            ELSE a.quantity_input
        END AS input,
        CASE
            WHEN (a.quantity_output IS NULL) THEN 0
            ELSE a.quantity_output
        END AS output,
        CASE
            WHEN (a.quantity_reverse_input IS NULL) THEN 0
            ELSE a.quantity_reverse_input
        END AS reverse_input,
        CASE
            WHEN (a.quantity_reverse_output IS NULL) THEN 0
            ELSE a.quantity_reverse_output
        END AS reverse_output,
    ((COALESCE(a.quantity_input, 0) - COALESCE(a.quantity_reverse_input, 0)) - (COALESCE(a.quantity_output, 0) - COALESCE(a.quantity_reverse_output, 0))) AS total
   FROM public.close_days a
    -- JOIN public.view_presentacion b ON ((a.id_presentacion = b.id)))
  WHERE true;
  
  



CREATE FUNCTION public.view_total_antes_cierre(i_id_presentacion integer, i_cierre_dia date) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
DECLARE
        o_return numeric;
        
BEGIN
       o_return =0;
       SELECT 
        sum(cantidad_entrante - cantidad_reverso_entrante - (cantidad_saliente - cantidad_reverso_saliente))
       
       INTO o_return
       FROM public.cierre_diario 
       WHERE id_presentacion = i_id_presentacion AND cierre_dia < i_cierre_dia
       GROUP BY id_presentacion;         
       RETURN COALESCE(o_return,0);
END;
$$;

---
---
---
---


--CREATE FUNCTION public.cierre_diario(i_fec_desde date, i_fec_hasta date, i_id_user integer) RETURNS character
--    LANGUAGE plpgsql
--    AS $$
--DECLARE
--        o_return character;
--        v_fecha date;        
--BEGIN
--	o_return:='Z';
--       IF (SELECT public.cierre_diario_fechas_validas(i_fec_desde, i_fec_hasta)) THEN
--		v_fecha = i_fec_desde;
--		WHILE v_fecha <= i_fec_hasta LOOP
--			IF  (SELECT public.cierre_diario_fecha_existe(v_fecha)) THEN
--			        SELECT public.cierre_diario_register(v_fecha, i_id_user) INTO o_return;				
--			END IF;
--			SELECT ( v_fecha + interval '1 day') INTO v_fecha; 
--		END LOOP;
--	END IF;  
--	
--	RETURN o_return;
--	
--END;
--$$;

--

--CREATE FUNCTION public.cierre_diario_fechas_validas(i_fecha_desde date, i_fecha_hasta date) RETURNS boolean
--    LANGUAGE plpgsql
--    AS $$
--BEGIN
--        RETURN (i_fecha_desde = (SELECT min(movimiento_fec) FROM public.movimiento WHERE cierre_fec IS NULL)) 
--               AND 
--               (i_fecha_hasta <= now());
--END;
--$$;

--

--CREATE FUNCTION public.cierre_diario_fecha_existe(i_fecha date) RETURNS boolean
--    LANGUAGE plpgsql
--    AS $$
--BEGIN
--
--        RETURN (SELECT CASE WHEN count(*)=0 THEN false ELSE true END 
--		FROM public.movimiento 
--			WHERE cierre_fec IS NULL AND movimiento_fec = i_fecha);
--
--END;
--$$;

--

CREATE FUNCTION public.cierre_diario_register(i_fecha date, i_id_user integer) RETURNS character
    LANGUAGE plpgsql
    AS $$
BEGIN
	INSERT INTO public.cierre_diario(
		id_presentacion, 
		cantidad_entrante, 
		cantidad_saliente, 
		cantidad_reverso_entrante, 
		cantidad_reverso_saliente, 
		cierre_dia, 
		id_user_insert
	) SELECT id_presentacion, 
		cantidad_entrante, 
		cantidad_saliente,
		cantidad_reverso_entrante, 
		cantidad_reverso_saliente, 
		i_fecha, 
		i_id_user
		FROM view_cierre_pre_insert
		WHERE movimiento_fec = i_fecha;
		
		
		/*
		  	INSERT INTO public.close_days(
		article_id, 
		quantity_input, 
		quantity_output, 
		quantity_reverse_input, 
		quantity_reverse_output, 
		close, 
		id_user_insert
	) SELECT article_id, 
		quantity_input, 
		quantity_output,
		quantity_reverse_input, 
		quantity_reverse_output, 
		now(), 
		1
		FROM view_closure_pre_insert
		WHERE movimiento_fec = i_fecha;
		*/
		
		
		
	UPDATE public.movimiento SET cierre_fec = now()
		WHERE movimiento_fec = i_fecha;
		
	UPDATE public.movimiento_aux SET cierre_fec = now()
		WHERE id_movimiento IN (SELECT id FROM public.movimiento WHERE movimiento_fec = i_fecha);
		
	RETURN 'C';
END;
$$;


-------------

select
  close,
  sum(quantity_input) as quantity_input,
  sum(quantity_output) as quantity_output,
  sum(quantity_reverse_input) as quantity_reverse_input,
  sum(quantity_reverse_output) as quantity_reverse_output  
from public.close_days
group by close;


---------------------
  

CREATE OR REPLACE FUNCTION public.daily_closing(i_date_from date, i_date_to date, i_user_id integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
        o_return boolean;
        v_date date;        
BEGIN
	o_return:=false;
        IF (SELECT public.daily_closing_valid_dates(i_date_from, i_date_to)) THEN
		v_date = i_date_from;
		WHILE v_date <= i_date_to LOOP
			IF  (SELECT public.daily_closing_date_exists(v_date)) THEN
			        SELECT public.daily_closing_register(v_date, i_user_id) INTO o_return;				
			END IF;
			SELECT ( v_date + interval '1 day') INTO v_date; 
		END LOOP;
	END IF;  
	
	RETURN o_return;
	
END;
$$;

CREATE OR REPLACE FUNCTION public.daily_closing_valid_dates(i_date_from date, i_date_to date) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
        RETURN (i_date_from = (SELECT min(date_time::date) FROM public.movements WHERE close IS NULL)) 
               AND 
               (i_date_to <= now());
END;
$$;


CREATE OR REPLACE FUNCTION public.daily_closing_date_exists(i_date date) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN

        RETURN (SELECT CASE WHEN count(*)=0 THEN false ELSE true END 
		FROM public.movements 
			WHERE close IS NULL AND date_time::date = i_date);

END;
$$;


CREATE OR REPLACE FUNCTION public.daily_closing_register(i_date date, i_user_id integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
	INSERT INTO public.close_days(
		article_id, 
		quantity_input, 
		quantity_output, 
		quantity_reverse_input, 
		quantity_reverse_output, 
		close, 
		id_user_insert
	) SELECT article_id, 
		quantity_input, 
		quantity_output,
		quantity_reverse_input, 
		quantity_reverse_output, 
		i_date, 
		i_user_id
		FROM view_closure_pre_insert
		WHERE date_time::date = i_date;		
		
	UPDATE public.movements SET close = now()
		WHERE date_time::date = i_date;
		
	UPDATE public.movement_details SET close = now()
		WHERE movement_id IN (SELECT id FROM public.movements WHERE date_time::date = i_date);
		
	RETURN true;
END;
$$;

select public.daily_closing_register('2024-11-22', 1) 

select public.daily_closing('2024-11-22', '2024-11-22', 1)






NEW

select 
  a.close, 
  a.article_id, 
  sum(a.total) as accumulator, 
  COALESCE(b.inputs, 0::bigint) as inputs, 
  COALESCE(b.outputs, 0::bigint) as outputs,
  (sum(a.total) + COALESCE(b.inputs, 0::bigint)) - COALESCE(b.outputs, 0::bigint) as total
from view_stock_close_day_by_day a 
left join view_stock_movement b
on b.article_id=a.article_id
group by a.close, a.article_id, b.inputs, b.outputs

select * from view_stock_movement


select * from view_stock_close_day_by_day


//////////

-- View: public.view_stock_close_day_by_day

-- DROP VIEW public.view_stock_close_day_by_day;

CREATE OR REPLACE VIEW public.view_stock_close_day_by_day
 AS
 SELECT a.close,
    a.article_id,
        CASE
            WHEN a.quantity_input IS NULL THEN 0
            ELSE a.quantity_input
        END AS inputs,
        CASE
            WHEN a.quantity_output IS NULL THEN 0
            ELSE a.quantity_output
        END AS outputs,
        CASE
            WHEN a.quantity_reverse_input IS NULL THEN 0
            ELSE a.quantity_reverse_input
        END AS reverse_inputs,
        CASE
            WHEN a.quantity_reverse_output IS NULL THEN 0
            ELSE a.quantity_reverse_output
        END AS reverse_outputs,
    COALESCE(a.quantity_input, 0) - COALESCE(a.quantity_reverse_input, 0) - (COALESCE(a.quantity_output, 0) - COALESCE(a.quantity_reverse_output, 0)) AS total
   FROM ( SELECT close_days.id,
            close_days.article_id,
            close_days.quantity_input,
            close_days.quantity_output,
            close_days.quantity_reverse_input,
            close_days.quantity_reverse_output,
            close_days.close
           FROM close_days) a
  WHERE true;

ALTER TABLE public.view_stock_close_day_by_day
    OWNER TO postgres;
    
    
    
    
    
    
    
    
    
    
    
    
    
    ---> let's go here
    
    SELECT article_id,
    sum(inputs) AS inputs,
    sum(outputs) AS outputs,
    sum(reverse_inputs) AS reverse_inputs,
    sum(reverse_outputs) AS reverse_outputs,
    sum(total) AS total
   FROM ( 
         SELECT view_stock_close_day.article_id,
            view_stock_close_day.inputs,
            view_stock_close_day.outputs,
            view_stock_close_day.reverse_inputs,
            view_stock_close_day.reverse_outputs,
            view_stock_close_day.total
           FROM view_stock_close_day) alias
  GROUP BY article_id;

  SELECT article_id,
    sum(inputs) AS inputs,
    sum(outputs) AS outputs,
    sum(reverse_inputs) AS reverse_inputs,
    sum(reverse_outputs) AS reverse_outputs,
    sum(total) AS total
   FROM ( SELECT view_stock_movement.article_id,
            view_stock_movement.inputs,
            view_stock_movement.outputs,
            view_stock_movement.reverse_inputs,
            view_stock_movement.reverse_outputs,
            view_stock_movement.total
           FROM view_stock_movement
         ) alias
  GROUP BY article_id;
  

-- View: public.view_total_articles_by_daily_closing

-- DROP VIEW public.view_total_articles_by_daily_closing;

CREATE OR REPLACE VIEW public.view_total_articles_by_daily_closing
 AS
 SELECT article_id,
    sum(total) AS total
   FROM ( SELECT view_stock_close_day.article_id,
            view_stock_close_day.total
           FROM view_stock_close_day) alias
  GROUP BY article_id;

ALTER TABLE public.view_total_articles_by_daily_closing
    OWNER TO postgres;


-- View: public.view_articles_sum_by_unclosed_movements

-- DROP VIEW public.view_articles_sum_by_unclosed_movements;

CREATE OR REPLACE VIEW public.view_articles_sum_by_unclosed_movements
 AS
 SELECT article_id,
    sum(inputs) AS inputs,
    sum(outputs) AS outputs,
    sum(reverse_inputs) AS reverse_inputs,
    sum(reverse_outputs) AS reverse_outputs,
    sum(total) AS total
   FROM ( SELECT view_stock_movement.article_id,
            view_stock_movement.inputs,
            view_stock_movement.outputs,
            view_stock_movement.reverse_inputs,
            view_stock_movement.reverse_outputs,
            view_stock_movement.total
           FROM view_stock_movement) alias
  GROUP BY article_id;

ALTER TABLE public.view_articles_sum_by_unclosed_movements
    OWNER TO postgres;


-- View: public.view_stocks_by_accumulated_plus_unclosed_movements

-- DROP VIEW public.view_stocks_by_accumulated_plus_unclosed_movements;

CREATE OR REPLACE VIEW public.view_stocks_by_accumulated_plus_unclosed_movements
 AS
 SELECT a.id,
    a.int_cod,
    a.name,
    COALESCE(b.total, 0::bigint) AS accumulated,
    COALESCE(c.inputs, 0::numeric) AS inputs,
    COALESCE(c.outputs, 0::numeric) AS outputs,
    COALESCE(c.reverse_inputs, 0::numeric) AS reverse_inputs,
    COALESCE(c.reverse_outputs, 0::numeric) AS reverse_outputs,
    COALESCE(b.total, 0::bigint)::numeric + (COALESCE(c.inputs, 0::numeric) - COALESCE(c.reverse_inputs, 0::numeric)) - (COALESCE(c.outputs, 0::numeric) - COALESCE(c.reverse_outputs, 0::numeric)) AS stock_current,
    a.stock_min,
    a.stock_max
   FROM articles a
     LEFT JOIN view_total_articles_by_daily_closing b ON b.article_id = a.id
     LEFT JOIN view_articles_sum_by_unclosed_movements c ON c.article_id = a.id
  ORDER BY a.id;

ALTER TABLE public.view_stocks_by_accumulated_plus_unclosed_movements
    OWNER TO postgres;


SELECT a.article_id,
    COALESCE(a.quantity_input, 0) AS inputs,
    COALESCE(a.quantity_output, 0) AS outputs,
    COALESCE(a.quantity_reverse_input, 0) AS reverse_inputs,
    COALESCE(a.quantity_reverse_output, 0) AS reverse_outputs,
    COALESCE(a.quantity_input, 0) - COALESCE(a.quantity_reverse_input, 0) - (COALESCE(a.quantity_output, 0) - COALESCE(a.quantity_reverse_output, 0)) AS total,
    a.close
   FROM ( SELECT close_days.id,
            close_days.article_id,
            close_days.quantity_input,
            close_days.quantity_output,
            close_days.quantity_reverse_input,
            close_days.quantity_reverse_output,
            close_days.close
           FROM close_days) a
  WHERE true;

 SELECT alias.article_id,
    sum(alias.total) AS total, close
   FROM ( SELECT view_stock_close_day_test.article_id,
            view_stock_close_day_test.total, close
           FROM view_stock_close_day_test) alias
		WHERE close='2024-12-16'
  GROUP BY alias.article_id, close;

   SELECT alias.article_id,
    sum(alias.total) AS total
   FROM ( SELECT view_stock_close_day_test.article_id,
            view_stock_close_day_test.total
           FROM view_stock_close_day_test WHERE close='2024-12-16') alias		 
  GROUP BY alias.article_id ;



17-12-2024

    select view_stock_close_day_test_2.article_id,
    sum(view_stock_close_day_test_2.total) AS total from view_stock_close_day_test_2 where close = '2024-12-14'
	GROUP BY view_stock_close_day_test_2.article_id

  select view_stock_close_day_test_2.article_id,
    sum(view_stock_close_day_test_2.total) AS total from view_stock_close_day_test_2 where close = '2024-12-15'
	GROUP BY view_stock_close_day_test_2.article_id

	  select view_stock_close_day_test_2.article_id,
    sum(view_stock_close_day_test_2.total) AS total from view_stock_close_day_test_2 where close = '2024-12-16'
	GROUP BY view_stock_close_day_test_2.article_id

    select alias.*, view_stock_close_day_test.*, alias.acumulado+view_stock_close_day_test.total as tt
	from view_stock_close_day_test
	left join (
      select view_stock_close_day_test_2.article_id,
      sum(view_stock_close_day_test_2.total) AS acumulado from view_stock_close_day_test_2 where
	  close >= '2024-12-14' and close < '2024-12-16'  
	  GROUP BY view_stock_close_day_test_2.article_id
	) alias on view_stock_close_day_test.article_id = alias.article_id
	where close = '2024-12-16'



	select * from articles
	inner join 
	(select alias.acumulado, view_stock_close_day_test.*, alias.acumulado+view_stock_close_day_test.total as tt
	from view_stock_close_day_test
	left join (
      select view_stock_close_day_test_2.article_id,
      sum(view_stock_close_day_test_2.total) AS acumulado from view_stock_close_day_test_2 where
	  close >= '2024-12-14' and close < '2024-12-16'  
	  GROUP BY view_stock_close_day_test_2.article_id
	) alias on view_stock_close_day_test.article_id = alias.article_id
	where close = '2024-12-16') as b
	on articles.id = b.article_id
