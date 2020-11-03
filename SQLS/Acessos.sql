SELECT DISTINCT SIGLA,NOME_BOTAO
FROM
(
SELECT USU.D0001_ID,USU_G.D0006_ID_GRUPO,GRP_FUNC.D0004_ID_PERFIL,PER_FUNC.D0002_ID_FUNCAO , 
FUNC_ACAO.D0003_ID_ACAO, FUNC.D0001_ID_FUNC,tab.d0004_string2 sigla ,tab_acao.d0004_string2 nome_botao 
FROM PUBLIC."S0011_USUARIO_GRUPO" USU_G
INNER JOIN PUBLIC."S0001_usuario" USU ON USU_G.D0001_ID = USU.D0001_ID 
INNER JOIN PUBLIC."S0007_GRUPO_PERFIL" GRP_FUNC ON GRP_FUNC.D0006_id_grupo = USU_G.D0006_ID_GRUPO  
INNER JOIN PUBLIC."S0005_PERFIL_FUNCAO" PER_FUNC ON PER_FUNC.D0004_ID_PERFIL = GRP_FUNC.D0004_ID_PERFIL 
INNER JOIN PUBLIC."S0003_FUNCAO_ACAO" FUNC_ACAO ON FUNC_ACAO.D0002_ID_FUNCAO = PER_FUNC.D0002_ID_FUNCAO
INNER JOIN PUBLIC."S0002_FUNCAO" FUNC ON FUNC_ACAO.D0002_ID_FUNCAO = FUNC.D0002_ID_FUNCAO 
inner join public."E0004_tabela" tab on tab.d0004_id = FUNC.D0001_ID_FUNC 
inner join public."E0004_tabela" tab_acao on tab_acao.d0004_id = FUNC_ACAO.D0003_ID_ACAO
WHERE USU.D0001_EMAIL = 'jm@gmail.com'   
) P
WHERE  LENGTH(NOME_BOTAO) > 0
;
