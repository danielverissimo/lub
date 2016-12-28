<?php namespace App\Traits\Firework;

interface CrudInterface {

	/**
	 * Return all entries.
	 *
	 * @return \Platform\Pages\Page
	 */
	public function findAll();

	/**
	 * Get an intem by it's primary key.
	 *
	 * @param  int  $id
	 * @return \Platform\Pages\Page
	 */
	public function find($id);

	/**
	 * Creates an item with the given data.
	 *
	 * @param  array  $data
	 * @return \Cartalyst\Pages\Page
	 */
	public function create(array $data);

	/**
	 * Updates a page with the given data.
	 *
	 * @param  int	$id
	 * @param  array  $data
	 * @return \Cartalyst\Pages\Page
	 */
	public function update($id, array $data);

	/**
	 * Deletes the given page.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);
}
