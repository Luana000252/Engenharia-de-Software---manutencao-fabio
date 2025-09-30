# MANUAL DO USUÁRIO - SISTEMA DE GESTÃO DE MANUTENÇÕES

**Versão:** 1.0  
**Desenvolvido para:** Fábio Ildefonso  

---

## 🚀 PRIMEIROS PASSOS

### Requisitos do Sistema
- **Navegador:** Chrome, Firefox, Edge ou Safari
- **Conexão:** Internet (para fontes e gráficos)
- **Resolução:** Mínima 1024x768 (responsivo para mobile)

### Como Acessar
1. Abra seu navegador
2. Digite: `http://localhost/Engenharia-de-Software---manutencao-fabio/`
3. Faça login com suas credenciais

### Login Padrão
- **Usuário:** `admin`
- **Senha:** `1234`

---

## 🏠 TELA PRINCIPAL

Após o login, você verá a **tela principal** com 4 opções:

### 📋 Menu Principal
- **👥 Clientes** - Gerenciar informações dos clientes
- **⚙️ Máquinas** - Cadastrar e controlar máquinas
- **🔧 Serviços** - Registrar manutenções realizadas
- **📊 Dashboard** - Visualizar relatórios e gráficos

### 🧭 Navegação
- **Sidebar:** Menu lateral fixo em todas as páginas
- **Logo:** Clique para voltar ao início
- **Sair:** Botão no canto inferior da sidebar

---

## 👥 GESTÃO DE CLIENTES

### Listar Clientes
1. Clique em **"Clientes"** no menu
2. Visualize todos os clientes cadastrados
3. Use os botões **"Editar"** ou **"Excluir"** conforme necessário

### Cadastrar Novo Cliente
1. Na tela de clientes, clique **"+ Novo Cliente"**
2. Preencha os campos:
   - **Nome:** Obrigatório
   - **Contato:** Telefone/email (opcional)
   - **Endereço:** Localização (opcional)
3. Clique **"Salvar Cliente"**

### Editar Cliente
1. Na lista de clientes, clique **"Editar"**
2. Modifique as informações desejadas
3. Clique **"Salvar Alterações"**

### Excluir Cliente
1. Na lista de clientes, clique **"Excluir"**
2. Confirme a exclusão na janela que aparecer
3. ⚠️ **Atenção:** Esta ação não pode ser desfeita

---

## ⚙️ GESTÃO DE MÁQUINAS

### Listar Máquinas
1. Clique em **"Máquinas"** no menu
2. Visualize todas as máquinas cadastradas
3. Veja informações como tipo, modelo e última manutenção

### Cadastrar Nova Máquina
1. Na tela de máquinas, clique **"+ Nova Máquina"**
2. Preencha os campos:
   - **Tipo:** Obrigatório (ex: Compressor, Bomba)
   - **Modelo:** Opcional
   - **Última Manutenção:** Data da última manutenção
   - **Cliente:** Selecione o proprietário
3. Clique **"Salvar Máquina"**

### Editar Máquina
1. Na lista de máquinas, clique **"Editar"**
2. Atualize as informações necessárias
3. Clique **"Salvar Alterações"**

---

## 🔧 GESTÃO DE SERVIÇOS

### Listar Serviços
1. Clique em **"Serviços"** no menu
2. Visualize todos os serviços registrados
3. Observe as **tags coloridas**:
   - 🟢 **Verde:** Preventiva
   - 🟠 **Laranja:** Corretiva
   - 🟡 **Amarelo:** Pendente
   - ✅ **Verde:** Finalizado

### Registrar Novo Serviço
1. Na tela de serviços, clique **"+ Registrar Serviço"**
2. Preencha os campos:
   - **Tipo:** Preventiva ou Corretiva
   - **Descrição:** Detalhes do serviço realizado
   - **Data:** Quando foi executado
   - **Cliente:** Para quem foi feito
   - **Máquina:** Qual equipamento
3. Clique **"Salvar Serviço"**

### Finalizar Serviço
1. Na lista de serviços, localize um serviço **"Pendente"**
2. Clique no botão **"Finalizar"**
3. O status mudará automaticamente para **"Finalizado"**

### Editar Serviço
1. Na lista de serviços, clique **"Editar"**
2. Modifique as informações necessárias
3. Clique **"Salvar Alterações"**

---

## 📊 DASHBOARD E RELATÓRIOS

### Dashboard Principal
1. Clique em **"Dashboard"** no menu
2. Visualize as **estatísticas gerais**:
   - Total de clientes
   - Total de máquinas
   - Total de serviços
3. Acesse **dashboards específicos** clicando nos cards

### Serviços Finalizados
1. No dashboard, clique no card **"Serviços Finalizados"**
2. Visualize:
   - Quantidade de serviços finalizados vs pendentes
   - Gráfico de pizza por cliente
3. Use o botão **"← Voltar ao Dashboard"** para retornar

### Tipos de Serviços
1. No dashboard, clique no card **"Tipos de Serviços"**
2. Compare:
   - Quantidade de preventivas
   - Quantidade de corretivas
   - Gráfico de barras comparativo

### Gráfico Geral
- **Localização:** Dashboard principal (parte inferior)
- **Tipo:** Gráfico de barras
- **Dados:** Quantidade de serviços por cliente
- **Interativo:** Passe o mouse sobre as barras para detalhes

---

## 🔐 SEGURANÇA E LOGOUT

### Logout Seguro
1. Clique em **"Sair"** na parte inferior da sidebar
2. Você será redirecionado para a tela de login
3. Sua sessão será encerrada automaticamente

### Dicas de Segurança
- Sempre faça logout ao terminar de usar
- Não compartilhe suas credenciais
- Feche o navegador em computadores públicos

---

## 📱 USO EM DISPOSITIVOS MÓVEIS

### Responsividade
- O sistema se adapta automaticamente ao seu dispositivo
- **Mobile:** Menu lateral se ajusta para telas pequenas
- **Tablet:** Layout otimizado para toque
- **Desktop:** Experiência completa

### Navegação Mobile
- **Toque:** Use toques simples nos botões
- **Scroll:** Deslize para navegar pelas tabelas
- **Zoom:** Funciona normalmente se necessário

---

## ❓ SOLUÇÃO DE PROBLEMAS

### Problemas Comuns

#### "Página não carrega"
- Verifique se o XAMPP está rodando
- Confirme se digitou o endereço correto
- Limpe o cache do navegador

#### "Erro de login"
- Verifique usuário: `admin`
- Verifique senha: `1234`
- Certifique-se de não ter espaços extras

#### "Botão não funciona"
- Aguarde o carregamento completo da página
- Verifique sua conexão com a internet
- Tente atualizar a página (F5)

#### "Gráficos não aparecem"
- Verifique sua conexão com a internet
- Aguarde alguns segundos para carregar
- Tente em outro navegador

### Mensagens de Erro

#### "Erro na conexão"
- O banco de dados pode estar offline
- Verifique se o MySQL está rodando no XAMPP

#### "Usuário ou senha inválidos"
- Confirme as credenciais de login
- Verifique se não há caracteres especiais

---

## 💡 DICAS DE USO

### Produtividade
- Use **Ctrl+F** para buscar informações nas tabelas
- Mantenha dados atualizados para relatórios precisos
- Finalize serviços regularmente para acompanhar progresso

### Melhores Práticas
- **Clientes:** Mantenha contatos atualizados
- **Máquinas:** Registre sempre a última manutenção
- **Serviços:** Seja detalhado nas descrições
- **Status:** Finalize serviços assim que concluídos

### Organização
- Cadastre clientes antes de máquinas
- Cadastre máquinas antes de serviços
- Use nomes padronizados para facilitar busca

---

## 📞 SUPORTE

### Informações do Sistema
- **Versão:** 1.0
- **Projeto:** Engenharia de Software - ADS

### Documentação Adicional
- **Relatório Técnico:** `RELATORIO_TECNICO.md`
- **Código Fonte:** Disponível no diretório do projeto

---

**🎯 Parabéns! Agora você está pronto para usar o Sistema de Gestão de Manutenções de forma eficiente e produtiva!**
