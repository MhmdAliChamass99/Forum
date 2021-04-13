 <script>
                           
                            </script>
<template>
    <div class="container" style="background-color:black;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="height:400px;">
                    <div class="card-header" id="x">Messages</div>

                    <div class="card-body" style="background-color:black;">
                        <div style="overflow-y: auto; max-height: 300px;" v-chat-scroll>
                        <li  v-for="(message,index) in messages" :key="index" style="color:white;">
                            <strong id="u" style="color:white;">{{message.user.name}}</strong>
                           
                           {{ message.message}}
                        </li>
                        </div>
                    </div>
                    <input @keydown="sendTypingEvent" @keyup.enter="sendMessage" v-model="newMessage" type="text" name="message" placeholder="Enter your message" class="form-control">
                    
                </div>
                <span class="text-muted" v-if="activeUser">{{activeUser.name}} is typing..</span>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Active Users</div>
                    <div class="card-body" style="background-color:black;">
                        <li class="p-2" style="color:white;" v-for="(user,index) in users" :key="index">
                            <strong style="color:white;">{{user.name}}</strong>
                            
                        </li>
                    </div>
                </div>
        </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        props:['user'],
       data(){
           return {
               messages:[],
               newMessage:'',
               users:[],
               activeUser:false,
           }
       },
       created(){
            this.fetchMessages();
            
            Echo.join('chat')
            .here(user=>{
                this.users=user;
            })
            .joining(user=>{
                this.users.push(user);
            })
            .leaving(user=>{
                this.users=this.users.filter(u=>u.id !=user.id);
            })
            .listen('MessageSent',(event)=>{
                this.messages.push(event.message);
            })
            .listenForWhisper('typing',user=>{
                this.activeUser=user;
                setTimeout(()=>{
                    this.activeUser=false;
                },2000);
            })
       },
       methods:{
           fetchMessages(){
               axios.get('/getmessages').then(response =>{
                   this.messages=response.data;
               })
           },

           sendMessage(){
               this.messages.push({
                   user:this.user,
                   message:this.newMessage
               });
               axios.post('messages',{message:this.newMessage});
               this.newMessage=''
              
           },
           sendTypingEvent()
           {
               Echo.join('chat')
                .whisper('typing',this.user);
           }
           
       }
    }
    
</script>
