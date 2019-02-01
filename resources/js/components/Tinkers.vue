<template>

<div class="container">
        <div class="row"  v-for="message in messages" >
<div  :class="message.isMine ? 'confetti-button' : 'confetti-button-right'" v-html="message.text"
 >

     
</div>
<div v-if="message.original.type === 'actions'" class="rows">
<div v-if="message.original.type === 'actions'" class="btnfloat" :class="message.isMine ? 'confetti-button' : 'confetti-button-right'" v-for="action in message.original.actions">
                    <div class="btn" 
                         @click="performAction(action.value, message.original,action.text)">
                        <img v-if="action.image_url" :src="action.image_url" style="max-height: 25px" />
                        {{ action.text }}
                    </div>
                    
                </div>
                     </div>
</div>



        <input type="text" value="" @keyup.enter="sendMessage" v-model="newMessage" class="form__field" placeholder="Text Message" />
       
 

</div>

</template>

<style>
   h1 { margin-top:150px;}
.confetti-button {
    font-family: 'Helvetica', 'Arial', sans-serif;
    display: inline-block;
    font-size: 1em;
    padding: 1em 2em;
    -webkit-appearance: none;
    appearance: none;
    background-color: #ff0081;
    color: #fff;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    position: relative;
    transition: transform ease-in 0.1s, box-shadow ease-in 0.25s;
    box-shadow: 0 2px 25px rgba(255, 0, 130, 0.5);
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 25px;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    float: right;
}

.confetti-button-right {
    font-family: 'Helvetica', 'Arial', sans-serif;
    display: inline-block;
    font-size: 1em;
    padding: 1em 2em;
    -webkit-appearance: none;
    appearance: none;
    background-color: #ff0081;
    color: #fff;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    position: relative;
    transition: transform ease-in 0.1s, box-shadow ease-in 0.25s;
    box-shadow: 0 2px 25px rgba(255, 0, 130, 0.5);
    border-bottom-right-radius: 25px;
    border-bottom-left-radius: 0px;
    border-top-left-radius: 25px;
    border-top-right-radius: 25px;
    float: left;
}

.confetti-button:focus { outline: 0; }

.confetti-button:before, .confetti-button:after {
  position: absolute;
  content: '';
  display: block;
  width: 140%;
  height: 100%;
  left: -20%;
  z-index: -1000;
  transition: all ease-in-out 0.5s;
  background-repeat: no-repeat;
}


.btn.focus, .btn:focus, .btn:hover {
    color: white;
}
.btn {
  display: inline-block;
  background: transparent;
  color: inherit;
  font: inherit;
  border: 0;
  outline: 0;
  padding: 0;
  transition: all 200ms ease-in;
  cursor: pointer;
}
.btn--primary {
  background: #ff0081;
  color: #fff;
  box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
  border-radius: 2px;
  padding: 12px 36px;
}
.btn--primary:hover {
  background: #ff0081;
}
.btn--primary:active {
  background: #ff0081;
  box-shadow: inset 0 0 10px 2px rgba(0, 0, 0, 0.2);
}
.btn--inside {
  margin-left: -96px;
}

.form__field {
    width: 98%;
    background: #fff;
    color: #a3a3a3;
    font: inherit;
    box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.1);
    border: 0;
    outline: 0;
    padding: 22px 18px;
    margin: 41px 0 0 0px;
}
.rows {
    float: left;
    margin: 12px 0 0 -12px;
    clear: both;
}

.btnfloat.confetti-button-right {
    margin: 0px 0px -5px 11px;
}
</style>

<script>
    const axios = require('axios');

    export default {
        props: {
            apiEndpoint: {
                default: '/botman',
            },
            userId: {
                default: +(new Date()),
            },
        },

        data() {
            return {
                messages: [],
                newMessage: null
            };
        },

        mounted() {
        
        },

        methods: {
            callAPI(text, interactive = false, attachment = null, callback) {
                let data = new FormData();
                const postData = {
                    driver: 'web',
                    userId: this.userId,
                    message: text,
                    attachment,
                    interactive,
                    attachment_data: null
                };

                Object.keys(postData).forEach(key => data.append(key, postData[key]));

                axios.post(this.apiEndpoint, data).then(response => {
                    const messages = response.data.messages || [];
                    messages.forEach(msg => {
                        this._addMessage(msg.text, msg.attachment, false, msg);
                    });
                    if (callback) {
                        callback(response.data);
                    }
                });
            },

            performAction(value, message,text) {
                 this._addMessage(text, null, true);
                this.callAPI(value, true, null, (response) => {
                    message.actions = null;
                });
            },

            _addMessage(text, attachment, isMine, original = {}) {
                this.messages.push({
                    'isMine': isMine,
                    'user': isMine ? '👨' : '🤖',
                    'text': text,
                    'original': original,
                    'attachment': attachment || {},
                });
            },

            sendMessage() {
                let messageText = this.newMessage;
                this.newMessage = '';
                if (messageText === 'clear') {
                    this.messages = [];
                    return;
                }

                this._addMessage(messageText, null, true);

                this.callAPI(messageText);
            }
        }
    }
</script>
