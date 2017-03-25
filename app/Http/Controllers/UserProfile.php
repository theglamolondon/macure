<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 29/11/2016
 * Time: 08:09
 */

namespace App\Http\Controllers;


use App\Http\HelperFunctions;
use App\IdentiteAcces;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait UserProfile
{
    use HelperFunctions;

    public function editProfil()
    {
        return view('auth.profile',[
            'me' => IdentiteAcces::where('id',Auth::user()->id)->with('equipeTravaux','utilisateur')->get()->toJson()
        ]);
    }

    public function sendResponseUpdateUser(Request $request, $returnToBack = null)
    {
        $this->validate($request,[
            "login" => "required|exists:identiteacces,login",
            "password" => "confirmed",
            "typeidentite_id" => "required|numeric",
            "autorisation" => "optional|array",
            "nom" => "required",
            "chargemaintenance" => "required_if:typeidentite_id,2|numeric",
            "chefequipe" => "required_if:typeidentite_id,2|numeric",
            "prenoms" => "required_if:typeidentite_id,1",
        ],[
            "login.exists" => "Le login est introuvable. Vérifirier que votre dans l'application.",
            "password.confirmed" => "Les deux mots de passe ne concordent pas.",
            "nom.required" => "Le nom est requis pour la création.",
            "prenoms.required_if" => "Un prénom est au moins requis pour la création de l'utilisateur"
        ]);

        try {
            $identite = IdentiteAcces::with('utilisateur','equipeTravaux')->where('login', $request->input('login'))->firstOrFail();
            $updater = [];
            if(!empty($request->input('password'))) {
                $updater['password'] = bcrypt($request->input('password'));
            }

            if($request->has('autorisation'))
            {
                $updater['autorisation'] = json_encode($request->input('autorisation'));
                //Policy
                $d = null;
                foreach ($request->input('jours') as $j) {
                    if($d){$d .= ',';}
                    $d .= $j;
                }
                $d = '-d '.$d;
                $h = '-t '.str_replace('-',' ',$request->input('horaires'));
                $updater['policy'] = $d.' | '.$h;
            }

            $identite->update($updater);

            $updater = [];
            if($identite->utilisateur){
                $updater['nom'] = $request->input('nom');
                $updater['prenoms'] = $request->input('prenoms');
                $updater['telephone'] = $request->input('telephone');
                $updater['email'] = $request->input('email');
                $identite->utilisateur->update($updater);
            }

            $updater2 = [];
            if($identite->equipeTravaux){
                $updater['nom'] = $request->input('nom');
                $updater['chargemaintenance'] = $request->input('chargemaintenance');
                $updater['chefequipe'] = $request->input('chefequipe');
                $identite->equipeTravaux->update($updater);
            }

            $this->withSuccess(['L\'utilisateur a été modifié avec succès']);

            return $returnToBack ? $returnToBack : redirect()->route('liste_users');

        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }
}