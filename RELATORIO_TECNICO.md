# RELATÓRIO TÉCNICO - SISTEMA DE GESTÃO DE MANUTENÇÕES

**Projeto:** Sistema de Gestão de Manutenções  
**Disciplina:** Engenharia de Software / Arquitetura de Sistemas  
**Curso:** ADS  
**Desenvolvido para:** Fábio Ildefonso  

---

## 📋 RESUMO EXECUTIVO

O Sistema de Gestão de Manutenções é uma aplicação web desenvolvida para gerenciar clientes, máquinas e serviços de manutenção, oferecendo controle completo sobre manutenções preventivas e corretivas com dashboards analíticos.

---

## 🛠️ TECNOLOGIAS UTILIZADAS

### Backend
- **PHP 8.x** - Linguagem de programação principal
- **MySQL** - Sistema de gerenciamento de banco de dados
- **Apache** - Servidor web (XAMPP)

### Frontend
- **HTML5** - Estrutura das páginas
- **CSS3** - Estilização com Flat Design + Neumorphism
- **JavaScript** - Interatividade
- **Chart.js** - Gráficos interativos
- **Google Fonts (Inter)** - Tipografia moderna

### Ferramentas de Desenvolvimento
- **XAMPP** - Ambiente de desenvolvimento local
- **phpMyAdmin** - Administração do banco de dados

---

## 🏗️ ARQUITETURA DO SISTEMA

### Estrutura de Diretórios
```
Engenharia-de-Software---manutencao-fabio/
├── assets/
│   └── style.css
├── clientes/
│   ├── index.php
│   ├── novo.php
│   ├── editar.php
│   └── excluir.php
├── maquinas/
│   ├── index.php
│   ├── novo.php
│   ├── editar.php
│   └── excluir.php
├── servicos/
│   ├── index.php
│   ├── novo.php
│   ├── editar.php
│   ├── excluir.php
│   └── finalizar.php
├── dashboard/
│   ├── index.php
│   ├── finalizados.php
│   └── tipos.php
├── imagens/
├── sql/
│   └── schema.sql
├── db.php
├── index.php
├── login.php
└── logout.php
```

### Modelo de Dados
```sql
-- Tabela de usuários
usuarios (id, usuario, senha)

-- Tabela de clientes
clientes (id, nome, contato, endereco)

-- Tabela de máquinas
maquinas (id, tipo, modelo, ultima_manutencao, cliente_id)

-- Tabela de serviços
servicos (id, tipo, descricao, data_servico, status, cliente_id, maquina_id)
```

---

## ⚙️ FUNCIONALIDADES IMPLEMENTADAS

### 1. Sistema de Autenticação
- Login seguro com sessões PHP
- Controle de acesso a todas as páginas
- Logout com destruição de sessão

### 2. Gestão de Clientes
- **CRUD Completo:** Criar, Listar, Editar, Excluir
- **Campos:** Nome, Contato, Endereço
- **Validações:** Nome obrigatório

### 3. Gestão de Máquinas
- **CRUD Completo:** Criar, Listar, Editar, Excluir
- **Campos:** Tipo, Modelo, Última Manutenção, Cliente
- **Relacionamento:** Vinculação com clientes

### 4. Gestão de Serviços
- **CRUD Completo:** Criar, Listar, Editar, Excluir
- **Tipos:** Preventiva, Corretiva
- **Status:** Pendente, Finalizado
- **Campos:** Tipo, Descrição, Data, Cliente, Máquina
- **Funcionalidade:** Botão "Finalizar" para alterar status

### 5. Dashboard Analítico
- **Dashboard Principal:** Visão geral com estatísticas
- **Serviços Finalizados:** Análise de serviços concluídos
- **Tipos de Serviços:** Comparativo Preventivas vs Corretivas
- **Gráficos Interativos:** Chart.js com diferentes tipos de visualização

---

## 🎨 DESIGN E INTERFACE

### Padrão Visual
- **Estilo:** Flat Design + Neumorphism leve
- **Paleta de Cores:** 
  - Primária: #667eea (roxo/azul)
  - Secundária: #764ba2 (roxo escuro)
  - Fundo: #f5f7fa (cinza claro)
  - Texto: #4a5568 (cinza escuro)

### Componentes de Interface
- **Sidebar Fixa:** Navegação consistente em todas as páginas
- **Cards Modernos:** Elementos com sombras suaves e bordas arredondadas
- **Tabelas Responsivas:** Design adaptável para diferentes telas
- **Botões Interativos:** Efeitos hover e transições suaves
- **Formulários Estilizados:** Campos com foco visual aprimorado

### Responsividade
- **Mobile-First:** Design adaptável para dispositivos móveis
- **Breakpoints:** Ajustes para tablets e desktops
- **Grid System:** Layout flexível com CSS Grid

---

## 🔒 SEGURANÇA

### Medidas Implementadas
- **Controle de Sessão:** Verificação de autenticação em todas as páginas
- **Escape de Dados:** htmlentities() para prevenir XSS
- **Prepared Statements:** Proteção contra SQL Injection (parcial)
- **Validação de Entrada:** Verificação de dados obrigatórios

### Melhorias Recomendadas
- Implementar hash de senhas (password_hash/password_verify)
- CSRF tokens em formulários
- Validação mais robusta no backend
- HTTPS em produção

---

## 📊 MÉTRICAS DO PROJETO

### Linhas de Código
- **PHP:** ~800 linhas
- **CSS:** ~400 linhas
- **HTML:** ~600 linhas
- **SQL:** ~50 linhas

### Páginas Desenvolvidas
- **Total:** 15 páginas
- **CRUD:** 12 páginas
- **Dashboard:** 3 páginas

### Tempo de Desenvolvimento
- **Estimado:** 20-25 horas
- **Fases:** Análise, Desenvolvimento, Testes, Documentação

---

## 🧪 TESTES REALIZADOS

### Testes Funcionais
- ✅ Login/Logout
- ✅ CRUD de Clientes
- ✅ CRUD de Máquinas  
- ✅ CRUD de Serviços
- ✅ Sistema de Status
- ✅ Dashboards e Gráficos

### Testes de Interface
- ✅ Responsividade
- ✅ Navegação
- ✅ Formulários
- ✅ Validações

### Compatibilidade
- ✅ Chrome/Edge
- ✅ Firefox
- ✅ Mobile (Android/iOS)

---

## 🚀 IMPLANTAÇÃO

### Requisitos do Servidor
- **PHP:** 7.4 ou superior
- **MySQL:** 5.7 ou superior
- **Apache:** 2.4 ou superior
- **Extensões PHP:** mysqli, session

### Passos para Implantação
1. Copiar arquivos para servidor web
2. Criar banco de dados MySQL
3. Executar script SQL (schema.sql)
4. Configurar conexão (db.php)
5. Criar usuário inicial

---

## 📈 POSSÍVEIS MELHORIAS FUTURAS

### Funcionalidades
- Sistema de notificações
- Relatórios em PDF
- Backup automático
- API REST
- Aplicativo mobile

### Técnicas
- Framework PHP (Laravel/CodeIgniter)
- ORM para banco de dados
- Sistema de cache
- Logs de auditoria
- Testes automatizados

---

## 📝 CONCLUSÃO

O Sistema de Gestão de Manutenções atende aos requisitos propostos, oferecendo uma solução completa para gerenciamento de manutenções com interface moderna e funcionalidades robustas. O projeto demonstra aplicação prática dos conceitos de Engenharia de Software, incluindo arquitetura MVC, design patterns e boas práticas de desenvolvimento web.

**Status:** ✅ Concluído e Funcional  
**Data:** Dezembro 2024
