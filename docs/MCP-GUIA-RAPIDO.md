# MCP - Guia Rápido de Resolução

## Onde fica cada arquivo

| App | Arquivo |
|-----|---------|
| VS Code | `.mcp.json` (raiz do projeto) |
| Cursor | `%USERPROFILE%\.cursor\mcp.json` |
| Claude Desktop | `%APPDATA%\Claude\claude_desktop_config.json` |

---

## Não está funcionando? Siga estes passos:

### VS Code (Claude Code)

```bash
# 1. Ver status
claude mcp list

# 2. Se erro, resetar
claude mcp remove laravel-boost
claude mcp remove tailwindcss
claude mcp add --transport stdio laravel-boost --scope project -- php artisan boost:mcp
claude mcp add --transport stdio tailwindcss --scope project -- cmd /c npx -y tailwindcss-mcp-server

# 3. Recarregar VS Code
Ctrl+Shift+P → "Developer: Reload Window"
```

> **IMPORTANTE (Windows):** Comandos `npx` devem ser executados via `cmd /c` no Windows.

### Cursor

```bash
# 1. Abrir arquivo
notepad %USERPROFILE%\.cursor\mcp.json

# 2. Colar configuração (ver abaixo)

# 3. Fechar e abrir Cursor
```

### Claude Desktop

```bash
# 1. Abrir arquivo
notepad %APPDATA%\Claude\claude_desktop_config.json

# 2. Colar configuração (ver abaixo)

# 3. Fechar completamente e abrir
```

---

## Configurações Prontas para Copiar

### VS Code (.mcp.json)

```json
{
  "mcpServers": {
    "laravel-boost": {
      "type": "stdio",
      "command": "php",
      "args": ["artisan", "boost:mcp"],
      "env": {}
    },
    "tailwindcss": {
      "type": "stdio",
      "command": "cmd",
      "args": ["/c", "npx", "-y", "tailwindcss-mcp-server"],
      "env": {}
    }
  }
}
```

### Cursor (~/.cursor/mcp.json)

```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "php",
      "args": ["artisan", "boost:mcp"],
      "cwd": "C:\\laragon\\www\\vilafogoebrasa-prod"
    },
    "tailwindcss": {
      "command": "cmd",
      "args": ["/c", "npx", "-y", "tailwindcss-mcp-server"]
    }
  }
}
```

### Claude Desktop (claude_desktop_config.json)

```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "php",
      "args": ["artisan", "boost:mcp"],
      "cwd": "C:\\laragon\\www\\vilafogoebrasa-prod"
    },
    "tailwindcss": {
      "command": "cmd",
      "args": ["/c", "npx", "-y", "tailwindcss-mcp-server"]
    }
  }
}
```

---

## Problemas Comuns

| Problema | Solução |
|----------|---------|
| npx demora/falha | `npm cache clean --force` |
| PHP não encontrado | Usar caminho completo: `C:\\laragon\\bin\\php\\php-8.4\\php.exe` |
| JSON inválido | Validar em https://jsonlint.com |
| Alteração não aplicou | Reiniciar a IDE completamente |
| Barras erradas | Usar `\\` no Windows, não `\` |
| Warning "cmd /c" no Windows | Usar `"command": "cmd"` com `"args": ["/c", "npx", ...]` |

---

## Encontrar Caminhos

```bash
where php
where npx
```

---

## Documentos Detalhados

- [MCP-VSCODE.md](./MCP-VSCODE.md) - VS Code completo
- [MCP-CURSOR.md](./MCP-CURSOR.md) - Cursor completo
- [MCP-CLAUDE-DESKTOP.md](./MCP-CLAUDE-DESKTOP.md) - Claude Desktop completo
