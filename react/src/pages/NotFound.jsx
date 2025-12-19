import React from 'react'
import { Link } from 'react-router-dom'

export default function NotFound() {
  return (
	<div class="page-404 section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="page-404__wrap">
						<div class="page-404__content">
							<h1 class="page-404__title">404</h1>
							<p class="page-404__text">Nô nồ <br /> Không có đâu!</p>
							<Link to = "/login"  class="page-404__btn">go back</Link>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  )
}
