# Documentação do Projeto - Sistema de Agendamento para Salão

## Descrição

Este projeto consiste em um sistema de agendamento para um salão de beleza. Ele permite aos administradores gerenciar clientes, serviços e agendamentos. Os clientes podem realizar agendamentos de forma simples, com autenticação segura e um painel intuitivo.

---

## Tecnologias Utilizadas

### Backend

- **Laravel**: Framework PHP robusto para aplicações web.
- **PHP 8.x**: Linguagem de programação principal para o projeto.
- **MySQL**: Banco de dados relacional para armazenar informações de clientes, agendamentos e serviços.
- **Composer**: Gerenciador de dependências PHP.

### Frontend

- **Tailwind CSS**: Framework CSS para estilização responsiva.
- **Blade Templates**: Motor de templates nativo do Laravel para a renderização de views.

### Outras Ferramentas

- **Git**: Controle de versão do código.
- **NPM**: Gerenciador de pacotes para dependências frontend.

---

## Como Rodar o Projeto

### **1. Requisitos Pré-requisitos**

- **PHP 8.x**
- **Composer**
- **MySQL**
- **Git**
- **Node.js e NPM** (Opcional para Tailwind CSS)

### **2. Clonar o Repositório**

```bash
git clone https://github.com/joao591/salon-scheduling-dsin.git
cd nome-do-repositorio
```

### **3. Instalar Dependências**

```bash
composer install
npm install
```

### **4. Configurar o Ambiente**

Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente:

```bash
cp .env.example .env
```

Altere as seguintes variáveis no arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### **5. Gerar a Key da Aplicação**

```bash
php artisan key:generate
```

### **6. Migrar Banco de Dados**

```bash
php artisan migrate
```

### **7. Popular o Banco de Dados (Opcional)**

```bash
php artisan db:seed
```

> **Nota:** Após executar este comando, o sistema criará automaticamente um usuário administrador com as seguintes credenciais:
> - **Email:** salon@adm.com
> - **Senha:** salon@123456

### **8. Compilar os Arquivos Frontend**

```bash
npm run dev
```

### **9. Iniciar o Servidor de Desenvolvimento**

```bash
php artisan serve
```

O servidor estará disponível em [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Funcionalidades Principais

### Para Administradores

- Gerenciamento de clientes.
- Gerenciamento de serviços.
- Gerenciamento de agendamentos.

### Para Clientes

- Visualização dos agendamentos.
- Cadastro de novos agendamentos.
- Autenticação segura.

# Imagens

## Login
![login](https://github.com/user-attachments/assets/fee59443-490b-4908-8fae-b75329603140)

## Listagem de Agendamentos (ADM)
![agendamentos_adm](https://github.com/user-attachments/assets/9f7323ba-c65e-4d1d-a16d-e84f639eadeb)

## Listagem de Agendamentos (USER)
![listagem_user](https://github.com/user-attachments/assets/bb40f1f1-bd7b-4f57-9ceb-dd4efd160053)

## Cadastro de Agendamento
![cadastro](https://github.com/user-attachments/assets/8f1c8493-b651-4af8-8fbf-142157775212)

## Edição de Agendamento
![edicao](https://github.com/user-attachments/assets/98761ed7-15b6-4160-96c0-3a13a63f8842)

## Listagem de Clientes
![clientes](https://github.com/user-attachments/assets/cd648435-0d34-4377-8ea5-cb625dbe37e9)

## Cadastro de Clientes
![cadastro_clientes](https://github.com/user-attachments/assets/36bc46da-1803-4957-b042-6ca12d35f605)

## Detalhamento de Clientes
![detalhes_clientes](https://github.com/user-attachments/assets/df6662ea-1794-4400-ac94-8e0a6149e107)

## Listagem de Serviços
![servicos](https://github.com/user-attachments/assets/9c01f45f-94a9-4acf-ac42-a0a9d13feba4)

## Cadastro de Serviços
![cadastro_servicos](https://github.com/user-attachments/assets/9fd70b47-7597-4c5b-aed9-13c355516f01)

## Edição de Serviços
![edicao_servicos](https://github.com/user-attachments/assets/3e855b96-4e10-480b-9bbd-d2eb99a640fa)

# Vídeo
https://github.com/user-attachments/assets/c7399892-21c2-43b5-af22-b456efd4dc01

