# MCP no Claude Desktop

## Arquivo

```
Windows: %APPDATA%\Claude\claude_desktop_config.json
Mac:     ~/Library/Application Support/Claude/claude_desktop_config.json
Linux:   ~/.config/Claude/claude_desktop_config.json
```

Caminho completo Windows:
```
C:\Users\<seu-usuario>\AppData\Roaming\Claude\claude_desktop_config.json
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
    },
    "filesystem": {
      "command": "npx",
      "args": ["-y", "@modelcontextprotocol/server-filesystem", "C:\\laragon\\www\\vilafogoebrasa-prod"]
    }
  }
}
```

---

## Como Configurar

### Passo 1: Abrir o arquivo
```bash
# Windows (CMD)
notepad %APPDATA%\Claude\claude_desktop_config.json

# Windows (PowerShell)
notepad $env:APPDATA\Claude\claude_desktop_config.json
```

### Passo 2: Colar configuração e salvar

### Passo 3: Reiniciar Claude Desktop
- Fechar completamente (verificar bandeja do sistema)
- Abrir novamente

### Passo 4: Verificar
Clique no ícone de martelo na caixa de mensagem. Os MCPs devem aparecer.

---

## Problema: Arquivo não existe

### Passo 1: Criar pasta
```bash
mkdir %APPDATA%\Claude
```

### Passo 2: Criar arquivo
```bash
notepad %APPDATA%\Claude\claude_desktop_config.json
```

Cole a configuração e salve.

---

## Problema: MCPs não aparecem

### Checklist:
1. [ ] Arquivo existe no caminho correto
2. [ ] JSON válido (testar em https://jsonlint.com)
3. [ ] Barras duplas no Windows (`\\`)
4. [ ] Claude Desktop reiniciado completamente
5. [ ] Comandos funcionam no terminal (`php -v`, `npx -v`)

---

## Problema: Erro de permissão / comando não encontrado

Usar caminhos completos:

```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "C:\\laragon\\bin\\php\\php-8.4\\php.exe",
      "args": ["artisan", "boost:mcp"],
      "cwd": "C:\\laragon\\www\\vilafogoebrasa-prod"
    },
    "tailwindcss": {
      "command": "C:\\Program Files\\nodejs\\npx.cmd",
      "args": ["-y", "tailwindcss-mcp-server"]
    }
  }
}
```

---

## Encontrar Caminhos no Windows

```bash
# Caminho do PHP
where php

# Caminho do NPX
where npx
```

---

## Após Qualquer Alteração

1. Salvar arquivo
2. Fechar Claude Desktop (verificar bandeja do sistema com botão direito → Sair)
3. Abrir novamente
4. Verificar ícone de martelo
