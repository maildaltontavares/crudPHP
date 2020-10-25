PGDMP     "    4            	    x            Main    12.3    12.3 J    w           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            x           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            y           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            z           1262    16393    Main    DATABASE     �   CREATE DATABASE "Main" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';
    DROP DATABASE "Main";
                postgres    false            �            1259    16655    E0001_tabela_padrao    TABLE     �   CREATE TABLE public."E0001_tabela_padrao" (
    d0001_id integer NOT NULL,
    d0001_descricao character varying(50) NOT NULL,
    d0001_sigla character varying(10)
);
 )   DROP TABLE public."E0001_tabela_padrao";
       public         heap    postgres    false            �            1259    16658     E0001_tabela_padrao_d0001_id_seq    SEQUENCE     �   CREATE SEQUENCE public."E0001_tabela_padrao_d0001_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public."E0001_tabela_padrao_d0001_id_seq";
       public          postgres    false    202            {           0    0     E0001_tabela_padrao_d0001_id_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public."E0001_tabela_padrao_d0001_id_seq" OWNED BY public."E0001_tabela_padrao".d0001_id;
          public          postgres    false    203            �            1259    16660    E0003_config_tp_d0003_id_seq    SEQUENCE     �   CREATE SEQUENCE public."E0003_config_tp_d0003_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999999
    CACHE 1;
 5   DROP SEQUENCE public."E0003_config_tp_d0003_id_seq";
       public          postgres    false            �            1259    16688    E0003_config_tp    TABLE     H  CREATE TABLE public."E0003_config_tp" (
    d0003_id integer DEFAULT nextval('public."E0003_config_tp_d0003_id_seq"'::regclass) NOT NULL,
    d0001_id integer,
    d0003_str1 character(1) NOT NULL,
    d0003_desc_str1 character varying(30) NOT NULL,
    d0003_str2 character(1),
    d0003_desc_str2 character varying(30),
    d0003_str3 character(1),
    d0003_desc_str3 character varying(30),
    d0003_flag1 character(1),
    d0003_desc_flag1 character varying(30),
    d0003_flag2 character(1),
    d0003_desc_flag2 character varying(30),
    d0003_flag3 character(1),
    d0003_desc_flag3 character varying(30),
    d0003_num1 character(1),
    d0003_desc_num1 character varying(30),
    d0003_num2 character varying(1),
    d0003_desc_num2 character varying(30),
    d0003_num3 character varying(1),
    d0003_desc_num3 character varying(30),
    d0003_data1 character varying(1),
    d0003_desc_data1 character varying(30),
    d0003_data2 character varying(1),
    d0003_desc_data2 character varying(30),
    d0003_data3 character varying(1),
    d0003_desc_data3 character varying(30)
);
 %   DROP TABLE public."E0003_config_tp";
       public         heap    postgres    false    204            �            1259    16698    E0004_tabela    TABLE        CREATE TABLE public."E0004_tabela" (
    d0004_id bigint NOT NULL,
    d0001_id integer NOT NULL,
    d0004_string1 character varying(100) NOT NULL,
    d0004_string2 character varying(100),
    d0004_string3 character varying(100),
    d0004_flag1 character varying(1),
    d0004_flag2 character varying(3),
    d0004_flag3 character varying(3),
    d0004_num1 integer,
    d0004_num2 double precision,
    d0004_num3 double precision,
    d0004_data1 date,
    d0004_data2 date,
    d0004_data3 date,
    d0001_sigla character varying(10)
);
 "   DROP TABLE public."E0004_tabela";
       public         heap    postgres    false            �            1259    16696    E0004_tabela_d0004_id_seq    SEQUENCE     �   CREATE SEQUENCE public."E0004_tabela_d0004_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public."E0004_tabela_d0004_id_seq";
       public          postgres    false    209            |           0    0    E0004_tabela_d0004_id_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public."E0004_tabela_d0004_id_seq" OWNED BY public."E0004_tabela".d0004_id;
          public          postgres    false    208            �            1259    16666    S0001_usuario    TABLE     �   CREATE TABLE public."S0001_usuario" (
    d0001_id integer NOT NULL,
    d0001_nome character varying(50) NOT NULL,
    d0001_email character varying(100) NOT NULL,
    d0001_senha character varying(100) NOT NULL,
    d0001_tel character varying(15)
);
 #   DROP TABLE public."S0001_usuario";
       public         heap    postgres    false            �            1259    24943     S0002_FUNCAO_D0002_ID_FUNCAO_seq    SEQUENCE     �   CREATE SEQUENCE public."S0002_FUNCAO_D0002_ID_FUNCAO_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999999
    CACHE 1;
 9   DROP SEQUENCE public."S0002_FUNCAO_D0002_ID_FUNCAO_seq";
       public          postgres    false            �            1259    24945    S0002_FUNCAO    TABLE     
  CREATE TABLE public."S0002_FUNCAO" (
    d0002_id_funcao integer DEFAULT nextval('public."S0002_FUNCAO_D0002_ID_FUNCAO_seq"'::regclass) NOT NULL,
    d0002_func_desc character varying(255) NOT NULL,
    d0001_id_func bigint,
    d0002_chave character varying(50)
);
 "   DROP TABLE public."S0002_FUNCAO";
       public         heap    postgres    false    210            �            1259    24971 (   S0003_FUNCAO_ACAO_D0003_ID_FUNC_ACAO_seq    SEQUENCE     �   CREATE SEQUENCE public."S0003_FUNCAO_ACAO_D0003_ID_FUNC_ACAO_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999999
    CACHE 1;
 A   DROP SEQUENCE public."S0003_FUNCAO_ACAO_D0003_ID_FUNC_ACAO_seq";
       public          postgres    false            �            1259    24973    S0003_FUNCAO_ACAO    TABLE       CREATE TABLE public."S0003_FUNCAO_ACAO" (
    d0003_id_func_acao integer DEFAULT nextval('public."S0003_FUNCAO_ACAO_D0003_ID_FUNC_ACAO_seq"'::regclass) NOT NULL,
    d0002_id_funcao bigint NOT NULL,
    d0003_id_acao bigint NOT NULL,
    d0003_chave character varying(50)
);
 '   DROP TABLE public."S0003_FUNCAO_ACAO";
       public         heap    postgres    false    212            �            1259    25012     S0004_PERFIL_D0004_ID_PERFIL_seq    SEQUENCE     �   CREATE SEQUENCE public."S0004_PERFIL_D0004_ID_PERFIL_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999999
    CACHE 1;
 9   DROP SEQUENCE public."S0004_PERFIL_D0004_ID_PERFIL_seq";
       public          postgres    false            �            1259    25014    S0004_PERFIL    TABLE     �   CREATE TABLE public."S0004_PERFIL" (
    d0004_id_perfil integer DEFAULT nextval('public."S0004_PERFIL_D0004_ID_PERFIL_seq"'::regclass) NOT NULL,
    d0004_desc_perfil character varying(100) NOT NULL,
    d0004_chave character varying(50)
);
 "   DROP TABLE public."S0004_PERFIL";
       public         heap    postgres    false    214            �            1259    25037 *   S0005_PERFIL_FUNCAO_D0005_ID_PERF_FUNC_seq    SEQUENCE     �   CREATE SEQUENCE public."S0005_PERFIL_FUNCAO_D0005_ID_PERF_FUNC_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999999
    CACHE 1;
 C   DROP SEQUENCE public."S0005_PERFIL_FUNCAO_D0005_ID_PERF_FUNC_seq";
       public          postgres    false            �            1259    25061    S0005_PERFIL_FUNCAO    TABLE        CREATE TABLE public."S0005_PERFIL_FUNCAO" (
    d0005_id_perf_func integer DEFAULT nextval('public."S0005_PERFIL_FUNCAO_D0005_ID_PERF_FUNC_seq"'::regclass) NOT NULL,
    d0002_id_funcao bigint,
    d0004_id_perfil bigint,
    d0005_chave character varying(50),
    d0005_ordem numeric
);
 )   DROP TABLE public."S0005_PERFIL_FUNCAO";
       public         heap    postgres    false    216            �            1259    25084    S0006_GRUPO    TABLE     �   CREATE TABLE public."S0006_GRUPO" (
    d0006_id_grupo bigint NOT NULL,
    d0006_desc_grupo character varying(100) NOT NULL,
    d0006_chave character varying(100)
);
 !   DROP TABLE public."S0006_GRUPO";
       public         heap    postgres    false            }           0    0    TABLE "S0006_GRUPO"    COMMENT     ?   COMMENT ON TABLE public."S0006_GRUPO" IS 'Grupos de usuarios';
          public          postgres    false    219            �            1259    25082    S0006_GRUPO_d0006_id_grupo_seq    SEQUENCE     �   CREATE SEQUENCE public."S0006_GRUPO_d0006_id_grupo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public."S0006_GRUPO_d0006_id_grupo_seq";
       public          postgres    false    219            ~           0    0    S0006_GRUPO_d0006_id_grupo_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public."S0006_GRUPO_d0006_id_grupo_seq" OWNED BY public."S0006_GRUPO".d0006_id_grupo;
          public          postgres    false    218            �            1259    25133 ,   S0007_GRUPO_PERFIL_D0007_ID_GRUPO_PERFIL_seq    SEQUENCE     �   CREATE SEQUENCE public."S0007_GRUPO_PERFIL_D0007_ID_GRUPO_PERFIL_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 999999999999
    CACHE 1;
 E   DROP SEQUENCE public."S0007_GRUPO_PERFIL_D0007_ID_GRUPO_PERFIL_seq";
       public          postgres    false            �            1259    25141    S0007_GRUPO_PERFIL    TABLE     4  CREATE TABLE public."S0007_GRUPO_PERFIL" (
    d0007_id_grupo_perfil bigint DEFAULT nextval('public."S0007_GRUPO_PERFIL_D0007_ID_GRUPO_PERFIL_seq"'::regclass) NOT NULL,
    d0006_id_grupo bigint NOT NULL,
    d0007_chave character varying(100),
    d0007_ordem bigint,
    d0004_id_perfil bigint NOT NULL
);
 (   DROP TABLE public."S0007_GRUPO_PERFIL";
       public         heap    postgres    false    220            �            1259    16669    s0001_usuario_d0001_id_seq    SEQUENCE     �   CREATE SEQUENCE public.s0001_usuario_d0001_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.s0001_usuario_d0001_id_seq;
       public          postgres    false    205                       0    0    s0001_usuario_d0001_id_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.s0001_usuario_d0001_id_seq OWNED BY public."S0001_usuario".d0001_id;
          public          postgres    false    206            �
           2604    16671    E0001_tabela_padrao d0001_id    DEFAULT     �   ALTER TABLE ONLY public."E0001_tabela_padrao" ALTER COLUMN d0001_id SET DEFAULT nextval('public."E0001_tabela_padrao_d0001_id_seq"'::regclass);
 M   ALTER TABLE public."E0001_tabela_padrao" ALTER COLUMN d0001_id DROP DEFAULT;
       public          postgres    false    203    202            �
           2604    16701    E0004_tabela d0004_id    DEFAULT     �   ALTER TABLE ONLY public."E0004_tabela" ALTER COLUMN d0004_id SET DEFAULT nextval('public."E0004_tabela_d0004_id_seq"'::regclass);
 F   ALTER TABLE public."E0004_tabela" ALTER COLUMN d0004_id DROP DEFAULT;
       public          postgres    false    209    208    209            �
           2604    16672    S0001_usuario d0001_id    DEFAULT     �   ALTER TABLE ONLY public."S0001_usuario" ALTER COLUMN d0001_id SET DEFAULT nextval('public.s0001_usuario_d0001_id_seq'::regclass);
 G   ALTER TABLE public."S0001_usuario" ALTER COLUMN d0001_id DROP DEFAULT;
       public          postgres    false    206    205            �
           2604    25087    S0006_GRUPO d0006_id_grupo    DEFAULT     �   ALTER TABLE ONLY public."S0006_GRUPO" ALTER COLUMN d0006_id_grupo SET DEFAULT nextval('public."S0006_GRUPO_d0006_id_grupo_seq"'::regclass);
 K   ALTER TABLE public."S0006_GRUPO" ALTER COLUMN d0006_id_grupo DROP DEFAULT;
       public          postgres    false    218    219    219            a          0    16655    E0001_tabela_padrao 
   TABLE DATA           W   COPY public."E0001_tabela_padrao" (d0001_id, d0001_descricao, d0001_sigla) FROM stdin;
    public          postgres    false    202   �e       f          0    16688    E0003_config_tp 
   TABLE DATA           �  COPY public."E0003_config_tp" (d0003_id, d0001_id, d0003_str1, d0003_desc_str1, d0003_str2, d0003_desc_str2, d0003_str3, d0003_desc_str3, d0003_flag1, d0003_desc_flag1, d0003_flag2, d0003_desc_flag2, d0003_flag3, d0003_desc_flag3, d0003_num1, d0003_desc_num1, d0003_num2, d0003_desc_num2, d0003_num3, d0003_desc_num3, d0003_data1, d0003_desc_data1, d0003_data2, d0003_desc_data2, d0003_data3, d0003_desc_data3) FROM stdin;
    public          postgres    false    207   g       h          0    16698    E0004_tabela 
   TABLE DATA           �   COPY public."E0004_tabela" (d0004_id, d0001_id, d0004_string1, d0004_string2, d0004_string3, d0004_flag1, d0004_flag2, d0004_flag3, d0004_num1, d0004_num2, d0004_num3, d0004_data1, d0004_data2, d0004_data3, d0001_sigla) FROM stdin;
    public          postgres    false    209   eh       d          0    16666    S0001_usuario 
   TABLE DATA           d   COPY public."S0001_usuario" (d0001_id, d0001_nome, d0001_email, d0001_senha, d0001_tel) FROM stdin;
    public          postgres    false    205   �k       j          0    24945    S0002_FUNCAO 
   TABLE DATA           f   COPY public."S0002_FUNCAO" (d0002_id_funcao, d0002_func_desc, d0001_id_func, d0002_chave) FROM stdin;
    public          postgres    false    211   )l       l          0    24973    S0003_FUNCAO_ACAO 
   TABLE DATA           n   COPY public."S0003_FUNCAO_ACAO" (d0003_id_func_acao, d0002_id_funcao, d0003_id_acao, d0003_chave) FROM stdin;
    public          postgres    false    213   m       n          0    25014    S0004_PERFIL 
   TABLE DATA           Y   COPY public."S0004_PERFIL" (d0004_id_perfil, d0004_desc_perfil, d0004_chave) FROM stdin;
    public          postgres    false    215   �m       p          0    25061    S0005_PERFIL_FUNCAO 
   TABLE DATA              COPY public."S0005_PERFIL_FUNCAO" (d0005_id_perf_func, d0002_id_funcao, d0004_id_perfil, d0005_chave, d0005_ordem) FROM stdin;
    public          postgres    false    217   �n       r          0    25084    S0006_GRUPO 
   TABLE DATA           V   COPY public."S0006_GRUPO" (d0006_id_grupo, d0006_desc_grupo, d0006_chave) FROM stdin;
    public          postgres    false    219   (o       t          0    25141    S0007_GRUPO_PERFIL 
   TABLE DATA           �   COPY public."S0007_GRUPO_PERFIL" (d0007_id_grupo_perfil, d0006_id_grupo, d0007_chave, d0007_ordem, d0004_id_perfil) FROM stdin;
    public          postgres    false    221   {o       �           0    0     E0001_tabela_padrao_d0001_id_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public."E0001_tabela_padrao_d0001_id_seq"', 38, true);
          public          postgres    false    203            �           0    0    E0003_config_tp_d0003_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public."E0003_config_tp_d0003_id_seq"', 75, true);
          public          postgres    false    204            �           0    0    E0004_tabela_d0004_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public."E0004_tabela_d0004_id_seq"', 98, true);
          public          postgres    false    208            �           0    0     S0002_FUNCAO_D0002_ID_FUNCAO_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public."S0002_FUNCAO_D0002_ID_FUNCAO_seq"', 35, true);
          public          postgres    false    210            �           0    0 (   S0003_FUNCAO_ACAO_D0003_ID_FUNC_ACAO_seq    SEQUENCE SET     Z   SELECT pg_catalog.setval('public."S0003_FUNCAO_ACAO_D0003_ID_FUNC_ACAO_seq"', 120, true);
          public          postgres    false    212            �           0    0     S0004_PERFIL_D0004_ID_PERFIL_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public."S0004_PERFIL_D0004_ID_PERFIL_seq"', 88, true);
          public          postgres    false    214            �           0    0 *   S0005_PERFIL_FUNCAO_D0005_ID_PERF_FUNC_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public."S0005_PERFIL_FUNCAO_D0005_ID_PERF_FUNC_seq"', 601, true);
          public          postgres    false    216            �           0    0    S0006_GRUPO_d0006_id_grupo_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public."S0006_GRUPO_d0006_id_grupo_seq"', 6, true);
          public          postgres    false    218            �           0    0 ,   S0007_GRUPO_PERFIL_D0007_ID_GRUPO_PERFIL_seq    SEQUENCE SET     ]   SELECT pg_catalog.setval('public."S0007_GRUPO_PERFIL_D0007_ID_GRUPO_PERFIL_seq"', 15, true);
          public          postgres    false    220            �           0    0    s0001_usuario_d0001_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.s0001_usuario_d0001_id_seq', 16, true);
          public          postgres    false    206            �
           2606    16674 ,   E0001_tabela_padrao E0001_tabela_padrao_pkey 
   CONSTRAINT     t   ALTER TABLE ONLY public."E0001_tabela_padrao"
    ADD CONSTRAINT "E0001_tabela_padrao_pkey" PRIMARY KEY (d0001_id);
 Z   ALTER TABLE ONLY public."E0001_tabela_padrao" DROP CONSTRAINT "E0001_tabela_padrao_pkey";
       public            postgres    false    202            �
           2606    16695 ,   E0003_config_tp E0003_config_tp_d0001_id_key 
   CONSTRAINT     o   ALTER TABLE ONLY public."E0003_config_tp"
    ADD CONSTRAINT "E0003_config_tp_d0001_id_key" UNIQUE (d0001_id);
 Z   ALTER TABLE ONLY public."E0003_config_tp" DROP CONSTRAINT "E0003_config_tp_d0001_id_key";
       public            postgres    false    207            �
           2606    16693 $   E0003_config_tp E0003_config_tp_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public."E0003_config_tp"
    ADD CONSTRAINT "E0003_config_tp_pkey" PRIMARY KEY (d0003_id);
 R   ALTER TABLE ONLY public."E0003_config_tp" DROP CONSTRAINT "E0003_config_tp_pkey";
       public            postgres    false    207            �
           2606    16703    E0004_tabela E0004_tabela_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public."E0004_tabela"
    ADD CONSTRAINT "E0004_tabela_pkey" PRIMARY KEY (d0004_id);
 L   ALTER TABLE ONLY public."E0004_tabela" DROP CONSTRAINT "E0004_tabela_pkey";
       public            postgres    false    209            �
           2606    24950    S0002_FUNCAO S0002_FUNCAO_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public."S0002_FUNCAO"
    ADD CONSTRAINT "S0002_FUNCAO_pkey" PRIMARY KEY (d0002_id_funcao);
 L   ALTER TABLE ONLY public."S0002_FUNCAO" DROP CONSTRAINT "S0002_FUNCAO_pkey";
       public            postgres    false    211            �
           2606    24978 (   S0003_FUNCAO_ACAO S0003_FUNCAO_ACAO_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY public."S0003_FUNCAO_ACAO"
    ADD CONSTRAINT "S0003_FUNCAO_ACAO_pkey" PRIMARY KEY (d0003_id_func_acao);
 V   ALTER TABLE ONLY public."S0003_FUNCAO_ACAO" DROP CONSTRAINT "S0003_FUNCAO_ACAO_pkey";
       public            postgres    false    213            �
           2606    25019    S0004_PERFIL S0004_PERFIL_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public."S0004_PERFIL"
    ADD CONSTRAINT "S0004_PERFIL_pkey" PRIMARY KEY (d0004_id_perfil);
 L   ALTER TABLE ONLY public."S0004_PERFIL" DROP CONSTRAINT "S0004_PERFIL_pkey";
       public            postgres    false    215            �
           2606    25069 ,   S0005_PERFIL_FUNCAO S0005_PERFIL_FUNCAO_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO"
    ADD CONSTRAINT "S0005_PERFIL_FUNCAO_pkey" PRIMARY KEY (d0005_id_perf_func);
 Z   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO" DROP CONSTRAINT "S0005_PERFIL_FUNCAO_pkey";
       public            postgres    false    217            �
           2606    25089    S0006_GRUPO S0006_GRUPO_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public."S0006_GRUPO"
    ADD CONSTRAINT "S0006_GRUPO_pkey" PRIMARY KEY (d0006_id_grupo);
 J   ALTER TABLE ONLY public."S0006_GRUPO" DROP CONSTRAINT "S0006_GRUPO_pkey";
       public            postgres    false    219            �
           2606    25146 *   S0007_GRUPO_PERFIL S0007_GRUPO_PERFIL_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public."S0007_GRUPO_PERFIL"
    ADD CONSTRAINT "S0007_GRUPO_PERFIL_pkey" PRIMARY KEY (d0006_id_grupo, d0004_id_perfil);
 X   ALTER TABLE ONLY public."S0007_GRUPO_PERFIL" DROP CONSTRAINT "S0007_GRUPO_PERFIL_pkey";
       public            postgres    false    221    221            �
           2606    25021 %   S0004_PERFIL UNIQUE_D0004_DESC_PERFIL 
   CONSTRAINT     q   ALTER TABLE ONLY public."S0004_PERFIL"
    ADD CONSTRAINT "UNIQUE_D0004_DESC_PERFIL" UNIQUE (d0004_desc_perfil);
 S   ALTER TABLE ONLY public."S0004_PERFIL" DROP CONSTRAINT "UNIQUE_D0004_DESC_PERFIL";
       public            postgres    false    215            �
           2606    25071 &   S0005_PERFIL_FUNCAO UNIQUE_PERFIL_FUNC 
   CONSTRAINT     �   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO"
    ADD CONSTRAINT "UNIQUE_PERFIL_FUNC" UNIQUE (d0002_id_funcao, d0004_id_perfil);
 T   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO" DROP CONSTRAINT "UNIQUE_PERFIL_FUNC";
       public            postgres    false    217    217            �
           2606    25101    S0006_GRUPO descUnica 
   CONSTRAINT     `   ALTER TABLE ONLY public."S0006_GRUPO"
    ADD CONSTRAINT "descUnica" UNIQUE (d0006_desc_grupo);
 C   ALTER TABLE ONLY public."S0006_GRUPO" DROP CONSTRAINT "descUnica";
       public            postgres    false    219            �
           2606    16678     S0001_usuario s0001_usuario_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public."S0001_usuario"
    ADD CONSTRAINT s0001_usuario_pkey PRIMARY KEY (d0001_id);
 L   ALTER TABLE ONLY public."S0001_usuario" DROP CONSTRAINT s0001_usuario_pkey;
       public            postgres    false    205            �
           2606    24989    S0003_FUNCAO_ACAO fk_acao_grupo    FK CONSTRAINT     �   ALTER TABLE ONLY public."S0003_FUNCAO_ACAO"
    ADD CONSTRAINT fk_acao_grupo FOREIGN KEY (d0003_id_acao) REFERENCES public."E0004_tabela"(d0004_id);
 K   ALTER TABLE ONLY public."S0003_FUNCAO_ACAO" DROP CONSTRAINT fk_acao_grupo;
       public          postgres    false    2761    213    209            �
           2606    25072    S0005_PERFIL_FUNCAO fk_funcao    FK CONSTRAINT     �   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO"
    ADD CONSTRAINT fk_funcao FOREIGN KEY (d0002_id_funcao) REFERENCES public."S0002_FUNCAO"(d0002_id_funcao);
 I   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO" DROP CONSTRAINT fk_funcao;
       public          postgres    false    217    211    2763            �
           2606    25147    S0007_GRUPO_PERFIL fk_grupo    FK CONSTRAINT     �   ALTER TABLE ONLY public."S0007_GRUPO_PERFIL"
    ADD CONSTRAINT fk_grupo FOREIGN KEY (d0006_id_grupo) REFERENCES public."S0006_GRUPO"(d0006_id_grupo);
 G   ALTER TABLE ONLY public."S0007_GRUPO_PERFIL" DROP CONSTRAINT fk_grupo;
       public          postgres    false    219    221    2775            �
           2606    16709    E0003_config_tp fk_id_grupo    FK CONSTRAINT     �   ALTER TABLE ONLY public."E0003_config_tp"
    ADD CONSTRAINT fk_id_grupo FOREIGN KEY (d0001_id) REFERENCES public."E0001_tabela_padrao"(d0001_id);
 G   ALTER TABLE ONLY public."E0003_config_tp" DROP CONSTRAINT fk_id_grupo;
       public          postgres    false    202    207    2753            �
           2606    16714    E0004_tabela fk_id_grupo    FK CONSTRAINT     �   ALTER TABLE ONLY public."E0004_tabela"
    ADD CONSTRAINT fk_id_grupo FOREIGN KEY (d0001_id) REFERENCES public."E0001_tabela_padrao"(d0001_id);
 D   ALTER TABLE ONLY public."E0004_tabela" DROP CONSTRAINT fk_id_grupo;
       public          postgres    false    2753    209    202            �
           2606    25077    S0005_PERFIL_FUNCAO fk_perfil    FK CONSTRAINT     �   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO"
    ADD CONSTRAINT fk_perfil FOREIGN KEY (d0004_id_perfil) REFERENCES public."S0004_PERFIL"(d0004_id_perfil);
 I   ALTER TABLE ONLY public."S0005_PERFIL_FUNCAO" DROP CONSTRAINT fk_perfil;
       public          postgres    false    217    2767    215            �
           2606    25152    S0007_GRUPO_PERFIL fk_perfil    FK CONSTRAINT     �   ALTER TABLE ONLY public."S0007_GRUPO_PERFIL"
    ADD CONSTRAINT fk_perfil FOREIGN KEY (d0004_id_perfil) REFERENCES public."S0004_PERFIL"(d0004_id_perfil);
 H   ALTER TABLE ONLY public."S0007_GRUPO_PERFIL" DROP CONSTRAINT fk_perfil;
       public          postgres    false    2767    215    221            a   !  x�]PAN�@<ۯ�@�.��H#�BjD���,�JI�ZoPy����|'���3��v��mg��JJ.zj�����
VY�� �����X�_�9\ӹ~EMf/^�����1�(S֚��$��
����PT��\4����v��s�8�h�PR�h�w�W���
����}8т6��@ѵ�kn9H5�4������(y��ւz��zGth���'�:MQ��6܌�Z�.a�Z]s~P3A̗�zM�L�s&^��އ�:|j��9��q������f�N      f   C  x��SKN�0]�O�%lhm'J�UvT��+���b[��;pĂ�r1��6�RŚ��{3�G� $$�Ll��O+"8��G�p�|g�>A'<�JXV�q@��r|�]��=^�M�h[�� �u�^t��9���� x΃;J�ΨY�m���LΒ�A��8R���տ"��7���;��2U9�ҊB��Zm��i�V�h����`6����`�V�Ί�Z�
3������>[���]�y�^�[�+MT�h����F�~�Vt�,Kߖ���o�q[b�plQ��,�nw�7e:����$��c$�T�T��!��I�[      h   +  x��VKn�0]ӧ��B[���|`4N���*Zb�P�Q�=A�EV]=�.��(r�T�#m�G��{3�O<�̗�+rs��3/ �������Χ��$	b2+d�EM�%�����7����\�Mݭ�i!�a�������~�D������qL|��J��e�@&9�ɚ�<��m����B�6�Cp�l{�d��x��K�� 0��xZ�@_���n��_�3�[.�(���6/��:4�.�LWC�$J+;/t+x�;	L�W�,�r`�~dh��"/5j���$BG�-�h�v���e���|ZRй���4O��)��nr�Ż�v�]�4L$A�3�aǅ����T8Yq��宵C?) s�`��6��N��=��>!G6�p[@�k. �o�泲b��`��n+2B}���pB���	�W5�� ]r�Q�r2�Lv��&1	<r,xY�:�G.<����б���AݣVw��aΒU)�k����A�A�`}����b�=9'4XeK5��s��yua����y^l��� ���Fy��ȴ�1P��?{�֐���0���z�rk����I�̓K|�減�U(݂��H?3���k�關UF��������i��y��X����nDA���Py���i��!m�-���ZҒ	
��-�5�f��T��ZG�;��o-r� ���t˜^VOē7�T&�����ʺ��S�˶,k���+�����8����,��5ȫJ7O�.���v�vIh[+�H����|�I�]��_�DNh�x"S�\�G�,������/�_j�      d   y   x�3�,�,*)M���鹉�9z�����F�&��
�����fF\@�W~q��obQf"gV.��,����TNC#�&c#c.C�Ĕ��<ΔĜ��<��|�:��"���ff�
FF�&�\1z\\\ t�&�      j   �   x�u�=j1Fk������g��"�	����b+����J���,�X�o�4ӽǛ��K����{����ؗ�6�ew(�:�3���R2����6����!�Z���2�V��!  �@J0�$(�2,,O�tYW�Y0J��0��2ޅO�?�7 !p�$I�X����]��4vK����D���gϊ�m�E7{EL!(Y���A3�@��*�%zRj���om�z,      l   y   x�}��� Dѵ(&G?���T���=�mv��K�!�wt�E���P:i��N	=-&���mѻmz����uuUh��*��u�*'��DH��o��8�u������.2u�dά鈅q}�?�S-�      n   �   x�}��nC!�gx
����<F�UU�fA�JH�!�����m�����#��Ԯ���\�tX�ڿ��&O�P祧ܺ�ͼ��LɜQ�E"D�D��p@m���%ż�\s��vۦcO�EꭳDL�Ɋ�  �ͅ-�� b��j��-׏������h�w�9��,ax�����iT� �z.=u�+�ii��� ���H�#��qь(��X($N�<�6��zt~8pp��z������r>      p   z   x�}��1���C�H�l�q!��g�4=��ٰ�/0�'H
Z(j!���*`�h((��:ы'j�uW	1q/-��"��6x��|)kFk���=��̻~:��o�;׉��F�烈?��*�      r   C   x�3�t/*-�W00�420204026241027655���47�2�)1BVbhldfhndnabi����� u��      t   @   x�%���0B�3۩�%:A��#Q����0�~E=ށ%#���_:%����D75���k�ܻ��     