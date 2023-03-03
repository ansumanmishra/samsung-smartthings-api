# Samsung Smart Things API Integration
Here are the steps for integrating Smart Things API to Switch on/off TV

### Steps for generating token
-  Install Smart Things App (Android or IOS) in your mobile
-  Register device in the app (TV should be switched on. It might ask to enter code displayed in the TV for registration)
-  While registering it will ask for creating a new account
-  After successful registration, it will show the device in the App
-  Then open https://my.smartthings.com/ in the browser and login using the same credentials you used while registering the device
-  The registered device will appear after successful login
-  In a new tab open - https://account.smartthings.com/tokens
-  Click on Generate token
-  Give any name as token name, select device details in the checkoxes and click on generate
-  It will generate a token which will be used later in the APIs to switch on/off TV
### Steps for getting Device ID
- Open Postman or any Rest client
- Run the following request
    ```sh
    GET [https://api.smartthings.com/v1/devices]
    Authorization Bearer <TOKEN-GENERATED-EARLIER>
    content-type application/json
    ```
- It will return the response such as:
     ```sh
    {
        "items": [{
        "deviceId": "XXXX-XXXX-XXXX-XXXXXX",
        "other-props": "..."
        }]
    }
    ```
### Switch On/Off
- For Switching on the TV
    ```sh
    [POST] https://api.smartthings.com/v1/devices/{deviceId}/commands
    Authorization: Bearer {accessToken}
    Content-Type: application/json
    
    {
        "commands": [
            {
                "component": "main",
                "capability": "switch",
                "command": "on",
                "arguments": []
            }
        ]
    }
    ```
- For Switching off the TV
    ```sh
    [POST] https://api.smartthings.com/v1/devices/{deviceId}/commands
    Authorization: Bearer {accessToken}
    Content-Type: application/json
    
    {
        "commands": [
            {
                "component": "main",
                "capability": "switch",
                "command": "off",
                "arguments": []
            }
        ]
    }
    ```

- Follow the php script `smartthings-api.php` for a full implementation of the APIs for switching on/off the TV.
