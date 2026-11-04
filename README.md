📋 BRSVP - Sistema de Gestão de Convites e Participantes

> **Repositório de demonstração (vitrine).** Credenciais, hosts, e-mails e bibliotecas de runtime do ScriptCase (`_lib/`) foram removidos ou substituídos por placeholders. O código não é executável como está; serve para avaliação de estrutura e qualidade.
> Veja também [SECURITY.md](SECURITY.md) e [LICENSE](LICENSE).

Eventos Corporativos | RSVP Ativo | Gestão Completa de Convidados

Versão  1.20.10x | Documentação Técnica
🎯 1. VISÃO GERAL DO SISTEMA
O BRSVP é um sistema completo de gestão de convidados para eventos corporativos, desenvolvido pela UN Belvitur (BeFly). Diferentemente de sistemas RSVP passivos (apenas confirmação), o BRSVP gerencia ativamente todo o ciclo de vida do participante: desde o convite até o pós-evento, passando por gestão aérea, hospedagem, transfers, opcionais, programações e integração com aplicativos externos.

## 📂 Estrutura do Projeto

Abaixo está a organização dos diretórios principais do sistema BRSVP:

```text
brsvp_aws/
│
├── 🎛️ Navegação e Layout
│   ├── acesso_menus/                 # Menus por perfil de acesso
│   ├── administrativo_menu/          # Menu administrativo
│   ├── convidado_menu/               # Menu do convidado
│   └── blank_*                       # Telas base/modelo
│
├── 📊 Dashboards e Gráficos
│   ├── chart_aereos_rsvp/            # Gráficos - módulo aéreo
│   ├── chart_hospedagem_rsvp/        # Gráficos - hospedagem
│   ├── chart_participantes_rsvp/     # Gráficos - participantes
│   └── chart_presencas_rsvp/         # Gráficos - presenças
│
├── 📝 Formulários e Cadastros
│   ├── form_acompanhantes_rsvp/      # Formulário - acompanhantes
│   ├── form_aereos_rsvp_*/           # Formulários - aéreo
│   ├── form_bloqueio_aereo_rsvp/     # Bloqueio aéreo
│   ├── form_empresas_rsvp/           # Empresas participantes
│   ├── form_eventos_rsvp/            # Eventos internos
│   ├── form_hospedagem_rsvp/         # Hospedagem
│   ├── form_pagamentos_rsvp/         # Pagamentos
│   ├── form_participantes_rsvp/      # Cadastro de participantes
│   ├── form_presencas_rsvp/          # Confirmação de presença
│   ├── form_programac_rsvp/          # Programação do evento
│   ├── form_solicitacoes_rsvp/       # Solicitações especiais
│   └── form_tbl_*                    # Tabelas auxiliares (hotéis, cidades, etc)
│
├── 📑 Consultas e Relatórios (Grids)
│   ├── grid_acompanhantes_rsvp/      # Grids de consulta
│   ├── grid_aereos_rsvp/
│   ├── grid_eventos_rsvp/
│   ├── grid_participantes_rsvp/
│   ├── grid_pessoas_rsvp/
│   └── grid_usuarios_rsvp/
│
├── ⚙️ Controles e Operações
│   ├── control_bkp/                  # Backup do sistema
│   ├── control_bloq_ac/              # Bloqueio de acessos
│   ├── control_cv/                   # Controle de Check-in/out
│   ├── control_mailling/             # Mailing e campanhas
│   └── control_rel_01/               # Relatórios gerenciais
│
├── 🎟️ Operações de Evento e Check-in
│   ├── cv_chkinout/                  # Check-in/out digital
│   ├── envia_email/                  # Envio de e-mails
│   └── form_confirmacao_viagem_rsvp/ # Voucher de viagem
│
├── 🔒 Segurança e Acessos
│   ├── nlogin/                       # Módulo de login
│   ├── form_usuarios_rsvp/           # Gestão de usuários
│   └── form_usuarios_rsvp_2fa/       # Autenticação em 2 fatores
│
├── index.php
└── README.md

⚙️ 3. MÓDULOS FUNCIONAIS
O sistema é organizado nos seguintes grupos de funcionalidades (18 módulos principais):

🔐 Acesso e Segurança
acesso_menus/, nlogin/, control_bloq_ac/ - Login com 2FA, menus por perfil, bloqueio de acessos

👥 Convidados e Participantes
form_participantes_rsvp/, grid_participantes_rsvp/, chart_participantes_rsvp/, form_acompanhantes_rsvp/

✅ Presenças e Confirmações
form_presencas_rsvp/, chart_presencas_rsvp/, form_confirmacao_viagem_rsvp/ (Voucher)

✈️ Módulo Aéreo
form_aereos_rsvp_1/, form_aereos_rsvp_2/, grid_aereos_rsvp/, form_bloqueio_aereo_rsvp/, integração com GATE

🏨 Módulo de Hospedagem
form_hospedagem_rsvp/, grid_hospedagem_rsvp/, form_tbl_hoteis/, form_tbl_acomodacoes/

📅 Programação do Evento
form_programac_rsvp/, form_eventos_rsvp/, chart_aereos_rsvp/

💰 Módulo Financeiro
form_pagamentos_rsvp/, grid_pagamentos_rsvp/

📊 Relatórios
control_rel_01/, control_rel_02/, grid_rsvp_log/, charts diversos

📧 Comunicação
envia_email/, control_mailling/, form_contatos_ac_rsvp/

📝 Solicitações Especiais
form_solicitacoes_rsvp/, form_anotacoes_rsvp/

🚐 Transfer (Translado)
form_transfer_rsvp/, grid_transfer_rsvp/ - aéreo, local e próprio

🎁 Opcionais
form_eventos_opcionais_rsvp/, form_tbl_opcionais/ - seguros, city tour, etc.

👤 Usuários e Permissões
form_usuarios_rsvp/, grid_usuarios_rsvp/, form_usuarios_rsvp_2fa/, administrativo_menu/

🔌 API e Integrações
grid_rsvp_log_api/, form_aereos_rsvp_gate/, integração BeInvited

💾 Backup e Logs
control_bkp/, control_log_bkp/, form_rsvp_log/

🔄 Check-in/Check-out
cv_chkinout/ - controle de entrada/saída de participantes

🏢 Fornecedores e Tabelas Auxiliares
form_tbl_fornecedores/, form_tbl_cia_aereas/, form_tbl_cidades/, form_tbl_ufs/, form_tbl_paises/, form_tbl_rede_hoteis/, form_tbl_tours/

📋 Grids (Consultas Avançadas)
50+ grids dedicados a consultas, filtros e exportação de dados

🛠️ 4. TECNOLOGIAS UTILIZADAS
ScriptCase 10.1.005
PHP 8.2
Apache 2.4.53
MySQLi (mysqlnd 8.1.6)
XAMPP v3.3.0
HTML5/CSS3
JavaScript/jQuery
Google Authenticator (2FA)
Distribuição por Linguagem: PHP 92,9% | CSS 3,6% | JavaScript 2,7% | Hack 0,5% | HTML 0,2% | C# 0,1%

📋 5. PRÉ-REQUISITOS E INSTALAÇÃO
Hospedagem: VPS (recomendada) ou compartilhada
Pasta raiz: nrsvp (diretório principal)
Permissões especiais: Em hospedagens compartilhadas, a pasta wkhtmltopdf e subpastas devem ter atributo 777
Extensões PHP: mysqli, pdo_mysql
Proteção adicional: Source Guardian (para código protegido)

🚀 6. FUNCIONAMENTO
URL de Acesso: https://seudominio.exemplo.com.br/nrsvp/nlogin/

Fluxo de Uso (Resumo)
1. O colaborador contata o participante (telefone/aplicativo Be Invited(WhatsApp e ou email)
2. O participante confirma presença ou justifica ausência
3. Solicitações especiais são registradas (acompanhante extra, substituição, etc.)
4. Dados de voo, hospedagem, transfer e opcionais são configurados
5. Geração e envio do Voucher de Confirmação de Viagem (voos, hospedagem, transfer e outros).
6. Durante o evento: check-in/check-out digital
7. Pós-evento: relatórios e métricas consolidadas
8. Integração em tempo real com app Be Invited

Autenticação (Login com 2FA)
Código do usuário
Senha
Código de dois fatores (Google Authenticator)

🔗 7. API DE PROVISIONAMENTO (IGA)
Atendendo ao projeto de Identity Governance & Administration (IGA), o BRSVP possui uma API que gerencia o ciclo de vida de usuários:

Operação	Descrição
Criação de contas	Provisionamento de novos usuários
Atualização de atributos	Modificação de dados cadastrais
Suspensão/Desativação	Bloqueio temporário de contas
Exclusão de usuários	Remoção definitiva

🔄 8. INTEGRAÇÕES EXTERNAS
GATE: Sistema de reservas aéreas integrado
Principais APIs aéreas: Conexão nativa com fornecedores
Be Invited: Aplicativo gerenciador de eventos corporativos (comunicação em tempo real)

📞 9. CONTATO E SUPORTE
Diretoria UN Belvitur - BeFly
E-mail: contato@exemplo.com.br
Canais: E-mail corporativo | Microsoft Teams

📈 10. ESTATÍSTICAS DO SISTEMA
Tipo	Quantidade Aproximada	Exemplos
Formulários (form_*)	~70	form_participantes_rsvp, form_hospedagem_rsvp, form_aereos_rsvp_1
Grids (grid_*)	~60	grid_participantes_rsvp, grid_eventos_rsvp, grid_usuarios_rsvp
Gráficos (chart_*)	~10	chart_participantes_rsvp, chart_aereos_rsvp, chart_presencas_rsvp
Controles (control_*)	~15	control_bkp, control_rel_01, control_mailling
Tabelas auxiliares	~20	form_tbl_hoteis, form_tbl_cidades, form_tbl_cia_aereas
Documentação gerada a partir da estrutura real do sistema BRSVP e do descritivo técnico fornecido.

BRSVP - © UN Belvitur / BeFly | Todos os direitos reservados

📄 Documentação em HTML | Sistema BRSVP Corporativo | Versão 1.20.10x
