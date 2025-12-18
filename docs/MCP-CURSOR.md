# MCP no Cursor

## Arquivo
```
Windows: C:\Users\<seu-usuario>\.cursor\mcp.json
Mac:     ~/.cursor/mcp.json
Linux:   ~/.cursor/mcp.json
```

---

## Configuração para Este Projeto

Copie e cole no arquivo:

```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "php",
      "args": ["artisan", "boost:mcp"],
      "cwd": "C:\\laragon\\www\\vilafogoebrasa-prod"
    },
    "tailwindcss": {
      "command": "npx",
      "args": ["-y", "tailwindcss-mcp-server"]
    }
  }
}
```

---

## Como Configurar

### Opção 1: Via Interface
1. Abra Cursor
2. `Ctrl+Shift+J` → Abre configurações do Cursor
3. Busque "MCP" ou "Model Context Protocol"
4. Adicione os servidores

### Opção 2: Editar arquivo direto
```bash
# Windows (PowerShell)
notepad $env:USERPROFILE\.cursor\mcp.json

# Windows (CMD)
notepad %USERPROFILE%\.cursor\mcp.json
```

Cole a configuração acima e salve.

---

## Problema: MCPs não aparecem

### Passo 1: Verificar se arquivo existe
```bash
# Windows
dir %USERPROFILE%\.cursor\mcp.json

# Se não existir, criar a pasta
mkdir %USERPROFILE%\.cursor
```

### Passo 2: Criar/editar o arquivo
```bash
notepad %USERPROFILE%\.cursor\mcp.json
```

Cole a configuração e salve.

### Passo 3: Reiniciar Cursor
Feche completamente (verificar na bandeja do sistema) e abra novamente.

---

## Problema: Erro de JSON

Valide o JSON em: https://jsonlint.com

Erros comuns:
- Falta vírgula entre objetos
- Vírgula sobrando no último item
- Barras simples no Windows (usar `\\` não `\`)

---

## Problema: Comando não encontrado

Testar no terminal:
```bash
php -v
npx -v
```

Se não funcionar, usar caminhos completos:
```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "C:\\laragon\\bin\\php\\php-8.4\\php.exe",
      "args": ["artisan", "boost:mcp"],
      "cwd": "C:\\laragon\\www\\vilafogoebrasa-prod"
    }
  }
}
```

---

## Após Qualquer Alteração

1. Salvar arquivo
2. Fechar Cursor completamente
3. Abrir Cursor novamente
