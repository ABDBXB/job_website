import {useEffect, useRef, useState } from "react";
import Chatboticon from "./components/Chatboticon";
import Chatform from "./components/Chatform";
import ChatMessage from "./components/ChatMessage";


const App=()=> {
  const [ChatHistory, setChatHistory] = useState([]);
  const chatBodyRef = useRef();


   async function generateBotResponse(history) {
    //
    const updateHistory = (text) => {
      setChatHistory(prev => [...prev.filter(msg => msg.text !== "Thinking...."),
      { role: "model", text }]);
    };
    // new
    history = history.map(({ role, text }) => ({ role, parts: [{ text }] }));

    const requestOptions = {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ contents: history })
    };
    try {
      //
      const response = await fetch(import.meta.env.VITE_API_URL, requestOptions);
      const data = await response.json();
      if (!response.ok) throw new Error(data.error.message || "Something went wrong!");
    
      //
      const apiResponseText = data.candidates[0].content.parts[0].text.replace(/\*\*(.*?)\*\*/g, "$1")
        .trim();
      updateHistory(apiResponseText);
    }
    catch (error) {
      console.log(error);

    }

  };
  //scroll
  useEffect(()=> {
   chatBodyRef.current.scrollTo({top:chatBodyRef.current.scrollHeight,behavior:"smooth"});
  },[ChatHistory]);

  return (


    

    
    <div className="container">
      <div className="chatbot-popup">
        {/* Chatbot header */}
        <div className="chat-header">
            <h3>Chatbot</h3>
          </div>
          
        {/* Chatbot body */}
        <div ref={chatBodyRef} className="chat-body">
          <div className="message bot-message">
          <Chatboticon />
          <p className="message-text">
            Hello <br/>How can I help you to day
          </p>
          </div>
           {/* Render the chat history dynamically */}
           {ChatHistory.map((chat, index) => (
            <ChatMessage key={index} chat={chat} />
          ))}
        </div>


          {/* Chatbot footer */}
        <div className="chat-footer">
        <Chatform ChatHistory={ChatHistory} setChatHistory={setChatHistory} generateBotResponse= {generateBotResponse}/>
    
        </div>
      </div>
    </div>
  );
};

export default App;