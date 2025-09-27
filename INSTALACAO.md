# 🚀 GUIA DE INSTALAÇÃO - SISTEMA DE GESTÃO DE MANUTENÇÕES

## 📋 PRÉ-REQUISITOS

### Software Necessário
- **XAMPP** (Apache + MySQL + PHP)
- **Navegador Web** (Chrome, Firefox, Edge)
- **Git** (para clonar o repositório)

## 📥 INSTALAÇÃO

### 1. Clonar o Repositório
```bash
git clone https://github.com/SEU_USUARIO/sistema-manutencao-fabio.git
cd sistema-manutencao-fabio
```

### 2. Configurar XAMPP
1. Instale o XAMPP
2. Inicie **Apache** e **MySQL**
3. Copie o projeto para `C:\xampp\htdocs\`

### 3. Configurar Banco de Dados
1. Acesse: `http://localhost/phpmyadmin`
2. Crie um banco chamado `manutencao`
3. Execute o script SQL:
```sql
-- Copie e cole o conteúdo do arquivo sql/schema.sql
```

### 4. Configurar Conexão
Edite o arquivo `db.php` se necessário:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manutencao";
```

### 5. Acessar o Sistema
- **URL:** `http://localhost/sistema-manutencao-fabio/`
- **Login:** `admin`
- **Senha:** `1234`

## ✅ VERIFICAÇÃO

Teste se está funcionando:
1. Faça login
2. Cadastre um cliente
3. Cadastre uma máquina
4. Registre um serviço
5. Acesse o dashboard

## 🆘 PROBLEMAS COMUNS

### "Erro de conexão"
- Verifique se MySQL está rodando
- Confirme o nome do banco: `manutencao`

### "Página não encontrada"
- Verifique se Apache está rodando
- Confirme o caminho do projeto

### "Erro de permissão"
- No Linux/Mac: `chmod 755 -R pasta_do_projeto`

## 📞 SUPORTE

Em caso de problemas:
1. Verifique os logs do Apache/MySQL
2. Consulte o `MANUAL_USUARIO.md`
3. Consulte o `RELATORIO_TECNICO.md`