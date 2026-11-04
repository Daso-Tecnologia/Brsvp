# Nota de segurança (versão vitrine)

Este repositório é uma versão sanitizada: credenciais, hosts, IPs, e-mails e a
pasta `_lib/` (runtime do ScriptCase e conexões) foram removidos. Os campos
sensíveis usam placeholders (`SEU_CLIENT_ID`, `SEU_CLIENT_SECRET`, `SUA_CHAVE_GOOGLE_API`,
`SENHA_REMOVIDA`). Configure-os por variáveis de ambiente/arquivo fora do repositório.

## Endurecimentos aplicados nesta versão
- Senhas: `md5` sem salt substituído por `password_hash()`/`password_verify()`.
  O login aceita hashes `md5` legados e os migra para o novo formato no primeiro acesso.
  **Requer** `ALTER TABLE usuarios_rsvp MODIFY usuario_senha VARCHAR(255);` (bcrypt tem 60 caracteres).
- `curl`: verificação de certificado SSL habilitada (`VERIFYPEER=true`, `VERIFYHOST=2`).
- Login: consulta parametrizada por `qstr()` apenas pelo identificador; a senha é verificada em PHP.

## Reportar vulnerabilidade
Envie os detalhes de forma privada para o contato institucional, sem abrir issue pública.
