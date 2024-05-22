import React, { useEffect, useState } from 'react'
import { Textarea } from '../ui/textarea'

const StreamListener = () => {
  const [message, setMessage] = useState(['otin']);

  useEffect(() => {
    let stream = new EventSource('http://localhost:8088/stream', { withCredentials: false });
    stream.addEventListener('ping', (event) => {
      JSON.parse(event.data).forEach((m) => {
        console.log(m);
        setMessage([...message, m.description])
      })
    })
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [])


  return (
    <Textarea className='h-20' value={JSON.stringify(message)} onChange={() => JSON.stringify(message)} placeholder="Type your message here." />
  )
}

export default StreamListener
