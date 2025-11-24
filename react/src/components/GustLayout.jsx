import React from 'react'
import { Navigate, Outlet } from 'react-router-dom'
import { useStateContext } from '../contexts/ContextProvider'

export default function GustLayout() {
  const {token} = useStateContext()
  if(token){
    // debugger;
    return <Navigate to = "/"/>
  }
  return (
    <div>
      <Outlet/>
    </div>
  )
}
