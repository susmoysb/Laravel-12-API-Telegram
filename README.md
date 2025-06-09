<h1 align="center" style="font-size:2.5em;">Laravel 12 API Telegram</h1>

## About This Project
This project is a Laravel 12-based RESTful API designed to integrate seamlessly with Telegram. It provides endpoints for sending messages, managing Telegram bots. The API is structured for scalability, security, and ease of use, making it suitable for both small and large-scale Telegram automation tasks.

## Feature
- Send messages to Telegram Bot
- Send messages to Telegram Group
- Send messages to Telegram Channel
- Send photo to Telegram Bot
- Send photo to Telegram Group
- Send photo to Telegram Channel
- Send document to Telegram Bot
- Send document to Telegram Group
- Send document to Telegram Channel

## Requirements
- Telegram Account
- Telegram Bot Token (see [How to Get the Bot Token](#how-to-get-the-bot-token))
- Telegram Chat ID (see [How to Get the Chat ID](#how-to-get-the-chat-id))

## How to Get the Bot Token
To obtain your Telegram Bot Token:

1. Open Telegram and search for [@BotFather](https://t.me/BotFather).
2. Start a chat and use the `/newbot` command to create a new bot.
3. Follow the instructions to set a name and username for your bot.
4. After creation, BotFather will provide an HTTP API token.  
    Example: `123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ`
5. Copy and securely store this token; you’ll need it to authenticate API requests.

> **Note:** Keep your bot token private to prevent unauthorized access.

## How to Get the Chat ID
To interact with Telegram APIs, you need the chat ID for users, groups, or channels. Here’s how you can obtain it:

### For a User (Bot Conversation)
1. Start a conversation with your bot on Telegram.
2. Send any message to the bot.
3. Use the `getUpdates` method to retrieve the chat ID:
    ```
    https://api.telegram.org/bot<YOUR_BOT_TOKEN>/getUpdates
    ```
4. Look for the `chat` object in the response. The `id` field is the chat ID.

### For a Group
1. Add your bot to the group.
2. Send a message in the group.
3. Call the `getUpdates` endpoint as above.
4. Find the `chat` object with `"type": "group"` or `"type": "supergroup"`. The `id` is the group chat ID (usually a negative number).

### For a Channel
1. Add your bot as an administrator to the channel.
2. Post a message in the channel.
3. Call the `getUpdates` endpoint.
4. Find the `chat` object with `"type": "channel"`. The `id` is the channel chat ID (usually a negative number).

> **Tip:** You can also use Telegram bots like [userinfobot](https://t.me/userinfobot) to get your user or group chat ID quickly.
