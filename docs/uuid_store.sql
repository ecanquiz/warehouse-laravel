
select * from view_article_quantity_input order by store_uuid

select * from view_article_quantity_input where store_uuid = '44324059-154f-47a5-ba26-1a4d7ded9b89'

-- View: public.view_article_quantity_input

-- DROP VIEW public.view_article_quantity_input;

CREATE OR REPLACE VIEW public.view_article_quantity_input
 AS
 SELECT
    a.article_id,
    sum(a.quantity) AS quantity,
	b.store_uuid
   FROM movement_details a
     JOIN movements b ON a.movement_id = b.id AND b.close IS NULL
  WHERE b.type_id = 1
  GROUP BY a.article_id, b.store_uuid;

ALTER TABLE public.view_article_quantity_input
    OWNER TO postgres;


-- View: public.view_article_quantity_output

-- DROP VIEW public.view_article_quantity_output;

CREATE OR REPLACE VIEW public.view_article_quantity_output
 AS
 SELECT a.article_id,
    sum(a.quantity) AS quantity,
	b.store_uuid
   FROM movement_details a
     JOIN movements b ON a.movement_id = b.id AND b.close IS NULL
  WHERE b.type_id = 2
  GROUP BY a.article_id, b.store_uuid;

ALTER TABLE public.view_article_quantity_output
    OWNER TO postgres;

-- View: public.view_article_quantity_reverse_input

-- DROP VIEW public.view_article_quantity_reverse_input;

CREATE OR REPLACE VIEW public.view_article_quantity_reverse_input
 AS
 SELECT a.article_id,
    sum(a.quantity) AS quantity,
		b.store_uuid
   FROM movement_details a
     JOIN movements b ON a.movement_id = b.id AND b.close IS NULL
  WHERE b.type_id = 3
  GROUP BY a.article_id, b.store_uuid;

ALTER TABLE public.view_article_quantity_reverse_input
    OWNER TO postgres;

-- View: public.view_article_quantity_reverse_output

-- DROP VIEW public.view_article_quantity_reverse_output;

CREATE OR REPLACE VIEW public.view_article_quantity_reverse_output
 AS
 SELECT a.article_id,
    sum(a.quantity) AS quantity,
	b.store_uuid
   FROM movement_details a
     JOIN movements b ON a.movement_id = b.id AND b.close IS NULL
  WHERE b.type_id = 4
  GROUP BY a.article_id, b.store_uuid;

ALTER TABLE public.view_article_quantity_reverse_output
    OWNER TO postgres;

