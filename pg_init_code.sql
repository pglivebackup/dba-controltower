CREATE SEQUENCE public.cq_jobid
    INCREMENT 1
    START 1000
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

ALTER SEQUENCE public.cq_jobid
    OWNER TO postgres;
	
CREATE SEQUENCE public.cq_requestid
    CYCLE
    INCREMENT 1
    START 108
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

ALTER SEQUENCE public.cq_requestid
    OWNER TO postgres;
	
CREATE TABLE public.jobs
(
    job_id integer NOT NULL DEFAULT nextval('cq_jobid'::regclass),
    job_name character varying(100) COLLATE pg_catalog."default" NOT NULL,
    job_command character varying(250) COLLATE pg_catalog."default" NOT NULL,
    job_enabled bit(1) NOT NULL,
    last_outcome character varying(10) COLLATE pg_catalog."default",
    last_runtime timestamp without time zone,
    is_idle bit(1) NOT NULL,
    job_total_executions_count integer NOT NULL,
    job_total_failed_executions_count integer NOT NULL
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.jobs
    OWNER to postgres;

CREATE TABLE public.run_requests
(
    req_id integer NOT NULL DEFAULT nextval('cq_requestid'::regclass),
    job_id integer NOT NULL,
    is_waiting bit(1) NOT NULL
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.run_requests
    OWNER to postgres;

