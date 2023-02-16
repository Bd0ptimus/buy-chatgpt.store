/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
try {
    if (waitingPayment) {
        const channel = Echo.channel(channelName);
        // const channel = Echo.channel('public.payment.1');
        console.log('channel name : ', channelName);
        channel.subscribed(() => {
            console.log('subscribed !');
        }).listen('.payment-complete', (event) => {
            console.log(event);
            window.location.href = redirectRoute;
            // const message = event.message;
            // const li = document.createElement('li');
            // li.textContent = message;
            // listMesages.append(li);
        });


        // const form = document.getElementById('form');
        // const inputMessage = document.getElementById('input-message');
        // const listMesages = document.getElementById('list-message');
        // form.addEventListener('submit', function (event) {
        //     event.preventDefault();
        //     const userInput = inputMessage.value;
        //     console.log('message input : ', userInput);
        //     axios.post('/chat-message', {
        //         message: userInput,
        //     });

        // })
    }

} catch (Exceptions) { }





