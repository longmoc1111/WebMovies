import axios from 'axios'
import React, { useRef, useState } from 'react'
import { Link } from 'react-router-dom'
import axiosClient from './axios-client'
// console.log("BASE_URL =", import.meta.env.VITE_API_BASE_URL);
import { useStateContext } from '../contexts/ContextProvider'

export default function Signup() {
  const nameRef = useRef()
  const emailRef = useRef()
  const passwordRef = useRef()
  const passwordConfirmationRef = useRef()

  const [errors, setErrors] = useState(null);

  const {setUser, setToken} = useStateContext()

  const onSubmit = (ev) => {
    ev.preventDefault()
    const payload = {
		name: nameRef.current.value,
		email: emailRef.current.value,
		password: passwordRef.current.value,
		password_confirmation: passwordConfirmationRef.current.value
	}
  console.log(payload)
	axiosClient.post('/signup', payload)
	.then(({data}) => {
		setUser(data.user);
		setToken(data.token);
	})
	.catch(err => {
		const response = err.response;
		if(response && response.status === 422){
      setErrors(response.data.errors);
      
		}
	})
  }
 

  return (
    <div className="sign section--bg" data-bg="https://hotflix.volkovdesign.com/main/img/bg/section__bg.jpg">
      <div className="container">
        <div className="row">
          <div className="col-12">
            <div className="sign__content">
              <form onSubmit={onSubmit} className="sign__form">
                <a href="index.html" className="sign__logo">
                  <img src="" alt=""/>
                  <h1 style={{color: "#F9AB00"}}>Đăng ký</h1>
                </a>
                {errors && <div className='alert alert-warning'>
                  {Object.keys(errors).map(key => (
                    <p style={{margin:0}} key={key}>{errors[key][0]}</p>
                  ))}
                  </div>}
                   
                <div className="sign__group">
                  <input ref={nameRef} name="name" type="text" className="sign__input" placeholder="UserName"/>
                </div>

                <div className="sign__group">
                  <input ref={emailRef} name="email" type="text" className="sign__input" placeholder="Email"/>
                </div>

                <div className="sign__group">
                  <input ref={passwordRef} name="password" type="password" className="sign__input" placeholder="Password"/>
                </div>

                <div className="sign__group">
                  <input ref={passwordConfirmationRef} name="passwordConfirmation" type="password" className="sign__input" placeholder="Password Confirmation"/>
                </div>

                <button className="sign__btn" type="submit">Đăng ký</button>
                <span className="sign__text">
                  Đã có tài khoản? <Link to="/login">Đăng nhập!</Link>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
